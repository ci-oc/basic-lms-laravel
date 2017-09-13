<?php

namespace App\Jobs;

use App\JudgesConstraint;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\QuestionsOption;
use App\UsersAnswer;
use App\Question;
use Yusufs\Grader;
use App\UsersProblemAnswer;
use App\UsersTestCaseAnswer;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\FileUploadTrait;

class RemarkQuizJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FileUploadTrait;
    public $tries = 1;
    protected $request;
    protected $test;
    protected $quiz_id;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, Model $test, $quiz_id, $user_id)
    {
        $this->quiz_id = $quiz_id;
        $this->request = $request;
        $this->test = $test;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_id = $this->user_id;
        $result = 0;
        $request = $this->request;
        $test_id = $this->quiz_id;
        $test = $this->test;
        if (array_key_exists('questions', $request)) {
            foreach ($request['questions'] as $key => $question) {
                $status = 0;
                $question_grade = 0;
                if ($request['answers'][$question] != null
                    && QuestionsOption::findorFail($request['answers'][$question])->correct
                ) {
                    $status = 1;
                    $question_grade += floatval(Question::findorFail($question)->grade);
                    $result += $question_grade;
                }
                UsersAnswer::updateOrCreate([
                    'user_id' => $user_id,
                    'quiz_id' => $test_id,
                    'question_id' => $question,
                ],
                    [
                        'user_id' => $user_id,
                        'quiz_id' => $test_id,
                        'question_id' => $question,
                        'option_id' => $request['answers'][$question],
                        'correct' => $status,
                        'grade' => $question_grade
                    ]
                );
            }
        }
        if (array_key_exists('problems', $request)) {
            $judge_constraints = $judge_constraints = JudgesConstraint::get()->first()->toArray();
            $max_mem_limit = $judge_constraints['max_mem_limit'] * 1024;
            $max_time_limit = $judge_constraints['max_time_limit'] * 1000;
            $problems = array();
            foreach ($request['problems'] as $key => $problem) {
                $problems[] = Question::find($problem)->load('testcases', 'coding_languages');
            }
            foreach ($problems as $problem) {
                $user_code_path = '';
                $compile_status = '';
                $err_reason = '';
                $run_status = '';
                $time_consumed = '';
                $lang = '';
                $problem_grade = 0;
                $available_coding_languages = $problem->coding_languages;
                $available_coding_languages_compile_name = array();
                foreach ($available_coding_languages as $available_lang) {
                    $available_coding_languages_compile_name[] = $available_lang->compile_name;
                }
                if (array_key_exists('code_language', $request)) {
                    $lang = $request['code_language'][$problem->id];
                }
                if (!in_array($lang, $available_coding_languages_compile_name)) {
                    $lang = $available_coding_languages_compile_name[array_rand($available_coding_languages_compile_name)];
                }
                $sharp_judge = false;
                $correct = 0;
                $testcase_grade = 0;
                $user_code = '';
                $solved_problem = UsersProblemAnswer::updateOrCreate([
                    'user_id' => $user_id,
                    'quiz_id' => $test_id,
                    'problem_id' => $problem->id,
                ],
                    [
                        'user_code' => $request['user_code'][$problem->id],
                        'time_consumed' => $time_consumed,
                        'compile_status' => $compile_status,
                        'compile_err_reason' => $err_reason,
                        'run_status' => $run_status,
                        'code_language' => $lang,
                        'grade' => $problem_grade,
                    ]
                );
                if (count($problem->testcases) > 0) {
                    try {
                        $storage_path = storage_path() . DIRECTORY_SEPARATOR;
                        $grader = new Grader($storage_path);
                        if ($solved_problem['user_code_path'] != null) {
                            unlink($solved_problem['user_code_path']);
                        }
                        $user_code = $grader->saveScript($lang, $request['user_code'][$problem->id], null, $test_id, $problem->id);
                        if ($user_code['success'] == 1) {
                            $user_code_filename = $user_code['detail']['filename'];
                            $user_code_path = $storage_path . 'scripts' . DIRECTORY_SEPARATOR . $test_id . DIRECTORY_SEPARATOR . $problem->id . DIRECTORY_SEPARATOR . $user_code_filename;
                            $compilation_output = $grader->compile($user_code_filename, $test_id, $problem->id);
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
                                    $testcase_input = $grader->saveInput($testcase->input);
                                    $testcase_input_filename = $testcase_input['detail']['filename'];
                                    $testcase_input_path = $storage_path . 'input' . DIRECTORY_SEPARATOR . $testcase_input_filename;
                                    $testcase_correct_output = $grader->saveOutput($storage_path, $testcase->output);
                                    if ($testcase_correct_output['success'] == 1 && $testcase_input['success'] == 1) {
                                        $output_filename = $testcase_correct_output['detail']['filename'];
                                        $output_path = $storage_path . 'output' . DIRECTORY_SEPARATOR . $output_filename;
                                        $run_output = $grader->run($user_code_filename, $testcase_input_filename, $problem->time_limit, $problem->mem_limit, $max_mem_limit, $max_time_limit);
                                        $run_output_status = $run_output['detail']['result'];
                                        if ($run_output_status == 'OK') {
                                            $run_status = $run_output_status;
                                            $code_output_path = $storage_path . 'output' . DIRECTORY_SEPARATOR . $run_output['detail']['filename'];
                                            $comparing_output = $grader->compareFiles($output_path, $code_output_path, $judge_options);
                                            if ($comparing_output['judge'] != false) {
                                                if ($comparing_output['judge']['output_file_similarity'] == true) {
                                                    $correct++;
                                                    $correct_bool = 1;
                                                }
                                                UsersTestCaseAnswer::updateOrCreate([
                                                    'user_id' => $user_id,
                                                    'quiz_id' => $test_id,
                                                    'problem_id' => $solved_problem->id,
                                                    'testcase_id' => $testcase->id,
                                                ],
                                                    [
                                                        'output' => $this->readFile($code_output_path),
                                                        'correct' => $correct_bool,
                                                        'cpu_usage' => $run_output['detail']['cpu'] . $run_output['detail']['cpu_unit'],
                                                        'vsize' => $run_output['detail']['vsize'] . $run_output['detail']['vsize_unit'],
                                                        'rss' => $run_output['detail']['rss'] . $run_output['detail']['rss_unit'],
                                                    ]
                                                );
                                            }
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
                                        try {
                                            unlink($testcase_input_path);
                                            unlink($output_path);
                                            unlink($code_output_path);
                                        } catch (\Exception $e) {

                                        }
                                    }
                                }
                            } else {
                                //COMPILATION DID NOT SUCCESS
                                //REPLACING SCRIPT PATH WITH THE NAME " CODE " in order to hide its place in file structure.
                                $err_reason = str_replace('storage/scripts/' . $test_id . DIRECTORY_SEPARATOR . $problem->id . DIRECTORY_SEPARATOR . $user_code_filename, ' Code ', $compilation_output['message']);
                                $err_reason = str_replace('var/www/html/module', ' ', $err_reason);
                                $compile_status = 'Compile Error';
                            }
                        } else {
                            $compile_status = 'Compile Error';
                            $err_reason = $user_code['message'];
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
                    'user_code_path' => $user_code_path,
                ]);
                $result += $problem_grade;
                try {
                    unlink($storage_path . 'compiled' . DIRECTORY_SEPARATOR . $user_code_filename);
                } catch (\Exception $e) {

                }
            }
        }
        $test->update(['grade' => $result,
            'processing_status' => 'OK']);
    }

    public function failed(Exception $exception)
    {
        $result = 0;
        $test_id = $this->quiz_id;
        $test = $this->test;
        $test->update(['grade' => $result,
            'processing_status' => 'OK']);
    }
}