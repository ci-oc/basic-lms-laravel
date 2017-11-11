<?php

namespace App\Console\Commands;

use App\Question;
use App\UsersProblemAnswer;
use App\UsersQuiz;
use Illuminate\Console\Command;
use App\Quiz;
use App\Plagiarism\Moss;
use DOMDocument;
use Carbon\Carbon;
use App\PlagiarismResult;

class remark extends Command
{
    /**how to create command laravel task scheduling
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remark';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $quizzes = Quiz::all()->load('questions');
        foreach ($quizzes as $quiz) {
            $all_type_questions[] = $quiz->questions;
            $problems = Question::separateQuestionTypes($all_type_questions, 'JUDGE');
            $end_date = $quiz->end_date;
            if ($quiz->duration != null) {
                $exploded_duration = explode(':', $quiz->duration);
                $dt = Carbon::parse($end_date);
                $dt->addHours($exploded_duration[0]);
                $dt->addMinutes($exploded_duration[1]);
                $dt->addSeconds($exploded_duration[2]);
                $end_date = $dt->toDateTimeString();
            }
            if (Quiz::hasFinished($end_date) && $quiz->activate_plagiarism && !$quiz->checked_for_plagiarism) {
                if (count($problems) > 0) {
                    foreach ($problems as $problem) {
                        $langs = $problem->coding_languages()->pluck('compile_name');
                        foreach ($langs as $lang) {
                            $solved_problems_codes_paths = UsersProblemAnswer::where([['quiz_id', '=', $quiz->id],
                                ['code_language', '=', $lang]])->get();
                            if (count($solved_problems_codes_paths) >= 2) {
                                try {
                                    $moss = new MOSS();
                                    $moss_lang = $lang;
                                    if ($lang == 'cpp')
                                        $moss_lang = 'cc';
                                    $moss->setLanguage($moss_lang);
                                    $codes_paths = storage_path() . DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . $quiz->id . DIRECTORY_SEPARATOR . $problem->id . DIRECTORY_SEPARATOR;
                                    $moss->addByWildcard($codes_paths . '*.' . $lang);
                                    $url = (string)$moss->send();
                                    $url_user = $url;
                                    $curl_user = curl_init(trim($url_user));
                                    curl_setopt($curl_user, CURLOPT_RETURNTRANSFER, $url_user);
                                    curl_setopt($curl_user, CURLOPT_FOLLOWLOCATION, true);
                                    $user_status = curl_exec($curl_user);
                                    $DOM = new DOMDocument();
                                    $DOM->loadHTML($user_status);
                                    $tables = $DOM->getElementsByTagName('table');
                                    $rows = $tables->item(0)->getElementsByTagName('tr');
                                    $cols = $rows->item(0)->getElementsByTagName('th');
                                    $row_headers = NULL;
                                    foreach ($cols as $node) {
                                        $row_headers[] = $node->nodeValue;
                                    }
                                    $table = array();
                                    $rows = $tables->item(0)->getElementsByTagName('tr');
                                    foreach ($rows as $row) {
                                        $cols = $row->getElementsByTagName('td');
                                        $row = array();
                                        $i = 0;
                                        foreach ($cols as $node) {
                                            if ($row_headers == NULL)
                                                $row[] = $node->nodeValue;
                                            else
                                                $row[$row_headers[$i]] = explode(' ', $node->nodeValue, 2);
                                            $i++;
                                        }
                                        if ($row != null)
                                            $table[] = $row;
                                    }
                                    foreach ($table as $plagarism_output) {
                                        $user_1 = UsersProblemAnswer::where('user_code_path', '=', $plagarism_output['File 1'][0])->pluck('user_id')->first();
                                        $user_2 = UsersProblemAnswer::where('user_code_path', '=', $plagarism_output['File 2'][0])->pluck('user_id')->first();
                                        $percentage_1 = floatval(preg_replace('/[^A-Za-z0-9\-]/', '', $plagarism_output['File 1'][1]));
                                        $percentage_2 = floatval(preg_replace('/[^A-Za-z0-9\-]/', '', $plagarism_output['File 2'][1]));
                                        if ($percentage_1 > $quiz->plagiarism_percentage or $percentage_2 > $quiz->plagiarism_percentage) {
                                            PlagiarismResult::create([
                                                'user_quiz_id' => $quiz->id,
                                                'user_problem_id' => $problem->id,
                                                'user_1_id' => $user_1,
                                                'plagiarism_percentage_1' => $percentage_1,
                                                'user_2_id' => $user_2,
                                                'plagiarism_percentage_2' => $percentage_2,
                                                'lines_matched' => preg_replace('/[\n]/', '', $plagarism_output["Lines Matched\n"][0]),
                                            ]);
                                        }
                                        try {
                                            unlink($plagarism_output['File 1'][0]);
                                            unlink($plagarism_output['File 2'][0]);
                                        } catch (\Exception $e) {

                                        }
                                    }

                                } catch (\Exception $e) {

                                }
                            }
                        }
                    }

                }
                $quiz->update(['checked_for_plagiarism' => 1]);
                UsersQuiz::query()->update(['processing_status' => "OK"]);
            }
        }
    }
}
