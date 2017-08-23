<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\UsersProblemAnswer;
use App\UsersTestCaseAnswer;
use Illuminate\Http\Request;
use App\UsersQuiz;
use Illuminate\Support\Facades\Auth;
use App\QuestionsOption;
use App\UsersAnswer;
use App\Question;
use Mockery\Exception;
use Yusufs\Grader;

class SolveQuizController extends Controller
{
    use FileUploadTrait;

    /**
     * SolveQuizController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 0;
        $test_id = $request->input('quiz_id');
        $test = UsersQuiz::create([
            'user_id' => Auth::id(),
            'quiz_id' => $test_id,
            'grade' => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            $question_grade = 0;
            if ($request->input('answers.' . $question) != null
                && QuestionsOption::find($request->input('answers.' . $question))->correct
            ) {
                $status = 1;
                $result += floatval($request->input('question_grades.' . $question));
                $question_grade += floatval($request->input('question_grades.' . $question));
            }

            UsersAnswer::create([
                'user_id' => Auth::id(),
                'quiz_id' => $test_id,
                'question_id' => $question,
                'option_id' => $request->input('answers.' . $question),
                'correct' => $status,
                'grade' => $question_grade
            ]);
        }

        $problems = array();
        foreach ($request->input('problems', []) as $key => $problem) {
            $problems[] = Question::find($problem)->load('testcases');
        }
        foreach ($problems as $problem) {
            $compile_status = '';
            $err_reason = '';
            $run_status = '';
            $time_consumed = '';
            $problem_grade = 0;
            $lang = $request->input('code_language.' . $problem->id);
            $sharp_judge = false;
            $correct = 0;
            $testcase_grade = 0;
            $solved_problem = UsersProblemAnswer::create([
                'user_id' => Auth::id(),
                'quiz_id' => $test_id,
                'problem_id' => $problem->id,
                'user_code' => $request->input('user_code.' . $problem->id),
                'time_consumed' => $time_consumed,
                'compile_status' => $compile_status,
                'compile_err_reason' => $err_reason,
                'run_status' => $run_status,
                'grade' => $problem_grade,
            ]);
            if (count($problem->testcases) > 0) {
                try {
                    $user_code = Grader::saveScript($lang, $request->input('user_code.' . $problem->id));
                    if ($user_code['success'] == 1) {
                        $storage_path = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR;
                        $user_code_filename = $user_code['detail']['filename'];
                        $user_code_path = $storage_path . 'scripts' . DIRECTORY_SEPARATOR . $user_code_filename;
                        $compilation_output = Grader::compile($user_code_filename);
                        $compilation_status = $compilation_output['detail']['reason'];
                        $time_consumed = $compilation_output['detail']['time'] . $compilation_output['detail']['time_unit'];
                        if ($compilation_status == 'compiled') {
                            $compile_status = "Compiled Successfully";
                            foreach ($problem->testcases as $testcase) {
                                $correct_bool = 0;
                                $judge_options = '-';
                                foreach ($problem->judge_options as $key => $value) {
                                    if ($value->description != 'SJ')
                                        $judge_options .= $value->description;
                                    if ($value->description == 'SJ') {
                                        $sharp_judge = true;
                                    }
                                }
                                if (!$sharp_judge) {
                                    $testcase_grade = floatval($problem->grade) / count($problem->testcases);
                                }
                                $testcase_input = Grader::saveInput($testcase->input);
                                $testcase_input_filename = $testcase_input['detail']['filename'];
                                $testcase_input_path = $storage_path . 'input' . DIRECTORY_SEPARATOR . $testcase_input_filename;
                                $testcase_correct_output = Grader::saveOutput($storage_path, $testcase->output);
                                if ($testcase_correct_output['success'] == 1 && $testcase_input['success'] == 1) {
                                    $output_filename = $testcase_correct_output['detail']['filename'];
                                    $output_path = $storage_path . 'output' . DIRECTORY_SEPARATOR . $output_filename;
                                    $run_output = Grader::run($user_code_filename, $testcase_input_filename, $problem->time_limit, $problem->mem_limit);
                                    $run_output_status = $run_output['detail']['result'];
                                    if ($run_output_status == 'OK') {
                                        $run_status = $run_output_status;
                                        $code_output_path = $storage_path . 'output' . DIRECTORY_SEPARATOR . $run_output['detail']['filename'];
                                        $comparing_output = Grader::compareFiles($output_path, $code_output_path, $judge_options);
                                        if ($comparing_output['judge']['output_file_similarity'] == true) {
                                            $correct++;
                                            $correct_bool = 1;
                                        }
                                        UsersTestCaseAnswer::create([
                                            'user_id' => Auth::id(),
                                            'quiz_id' => $test_id,
                                            'problem_id' => $solved_problem->id,
                                            'testcase_id' => $testcase->id,
                                            'output' => $this->readFile($code_output_path),
                                            'correct' => $correct_bool,
                                            'cpu_usage' => $run_output['detail']['cpu'] . $run_output['detail']['cpu_unit'],
                                            'vsize' => $run_output['detail']['vsize'] . $run_output['detail']['vsize_unit'],
                                            'rss' => $run_output['detail']['rss'] . $run_output['detail']['rss_unit'],
                                        ]);
                                    } else {
                                        if ($run_output_status == 'RF')
                                            $run_status = 'Restricted Function';
                                        elseif ($run_output_status == 'ML')
                                            $run_status = 'Memory Limit Exceed';
                                        elseif ($run_output_status == 'OL')
                                            $run_status = 'Output Limit Exceed';
                                        elseif ($run_output_status == 'TL')
                                            $run_status = 'Time Limit Exceed';
                                        elseif ($run_output_status == 'RT')
                                            $run_status = 'Runtime Error';
                                        elseif ($run_output_status == 'AT')
                                            $run_status = 'Abnormal Termination';
                                        elseif ($run_output_status == 'IE')
                                            $run_status = 'Internal Error';
                                        elseif ($run_output_status == 'BP')
                                            $run_status = 'Bad Policy';
                                        break;
                                    }
                                }
                            }
                        } else {
                            $err_reason = str_replace('storage/scripts/' . $user_code_filename, ' Code ', $compilation_output['message']);
                            $compile_status = 'Compile Error';
                        }
                    }
                } catch (Exception $e) {

                }
            }
            if ($sharp_judge) {
                if (count($problem->testcases) == $correct)
                    $problem_grade += floatval($problem->grade);
            } else {
                $problem_grade += floatval($correct * $testcase_grade);
            }
            $solved_problem->update([
                'time_consumed' => $time_consumed,
                'compile_status' => $compile_status,
                'compile_err_reason' => $err_reason,
                'run_status' => $run_status,
                'grade' => $problem_grade,
            ]);
            $result += $problem_grade;
        }
        $test->update(['grade' => $result]);
        return redirect()->route('results.show', [$test->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
