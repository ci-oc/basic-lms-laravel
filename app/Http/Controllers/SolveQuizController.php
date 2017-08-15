<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\UsersProblemAnswer;
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
        $test = UsersQuiz::create([
            'user_id' => Auth::id(),
            'quiz_id' => $request->input('quiz_id'),
            'grade' => $result,
        ]);
//
//        foreach ($request->input('questions', []) as $key => $question) {
//            $status = 0;
//
//            if ($request->input('answers.' . $question) != null
//                && QuestionsOption::find($request->input('answers.' . $question))->correct
//            ) {
//                $status = 1;
//                $result++;
//            }
//            UsersAnswer::create([
//                'user_id' => Auth::id(),
//                'question_id' => $question,
//                'option_id' => $request->input('answers.' . $question),
//                'correct' => $status,
//            ]);
//        }

        $problems = array();
        $grade = 0;
        foreach ($request->input('problems', []) as $key => $problem) {
            $problems[] = Question::find($problem)->load('testcases');
            UsersProblemAnswer::create([
                'user_id' => Auth::id(),
                'problem_id' => $problem,
                'user_code' => $request->input('user_code.' . $problem),
                'grade' => $grade,
            ]);
        }
        foreach ($problems as $problem) {
            $lang = $request->input('code_language.' . $problem->id);
            if (count($problem->testcases) > 0) {
                try {
                    $user_code = Grader::saveScript($lang, $request->input('user_code.' . $problem->id));
                    if ($user_code['success'] == 1) {
                        $storage_path = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR;
                        $user_code_filename = $user_code['detail']['filename'];
                        $user_code_path = $storage_path . 'scripts' . DIRECTORY_SEPARATOR . $user_code_filename;
                        $compilation_output = Grader::compile($user_code_filename);
                        $compilation_status = $compilation_output['detail']['reason'];
                        if ($compilation_status == 'compiled') {
                            foreach ($problem->testcases as $testcase) {
                                $testcase_input = Grader::saveInput($testcase->input);
                                $testcase_input_filename = $testcase_input['detail']['filename'];
                                $testcase_input_path = $storage_path . 'input' . $testcase_input_filename;
                                $testcase_correct_output = $this->saveOutput($storage_path, $testcase->output);
                                if ($testcase_correct_output['success'] == 1 && $testcase_input['success'] == 1) {
                                    $output_filename = $testcase_correct_output['detail']['filename'];
                                    $output_path = $storage_path . 'output' . DIRECTORY_SEPARATOR . $output_filename;
                                    $run_output = Grader::run($user_code_filename, $testcase_input_filename, 1, 32000);
                                    $run_output_status = $run_output['detail']['result'];
                                    if ($run_output_status == 'OK') {
                                        echo "OK";
                                    } else {
                                        echo $run_output_status;
                                    }
                                    unlink($testcase_input_path);
                                    unlink($output_path);
                                }
                            }
                        }
                        unlink($user_code_path);
                    }
                } catch (Exception $e) {

                }
            }
        }
        $test->update(['grade' => $result]);
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
