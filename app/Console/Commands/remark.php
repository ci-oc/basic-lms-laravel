<?php

namespace App\Console\Commands;

use App\Question;
use App\UsersProblemAnswer;
use Illuminate\Console\Command;
use App\Quiz;
use App\Plagiarism\Moss;
use DOMDocument;

class remark extends Command
{
    /**
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
            if (Quiz::hasFinished($quiz->end_date) && $quiz->activate_plagiarism) {
                if (count($problems) > 0) {
                    foreach ($problems as $problem) {
                        $langs = $problem->coding_languages()->pluck('compile_name');
                        foreach ($langs as $lang) {
                            $solved_problems_codes_paths = UsersProblemAnswer::where([['quiz_id', '=', $quiz->id],
                                ['code_language', '=', $lang]])->get();
                            if (count($solved_problems_codes_paths) >= 2) {
                                $moss = new MOSS();
                                $moss->setLanguage($lang);
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
                                foreach ($solved_problems_codes_paths as $code_path) {
                                    $user_code_matches = array();
                                    foreach ($table as $plagarism_output) {
                                        if (trim($plagarism_output['File 1'][0]) == trim($code_path->user_code_path)) {
                                            $user_code_matches[] = floatval(preg_replace('/[^A-Za-z0-9\-]/', '', $plagarism_output['File 1'][1]));
                                        }
                                        if (trim($plagarism_output['File 2'][0]) == trim($code_path->user_code_path)) {
                                            $user_code_matches[] = floatval(preg_replace('/[^A-Za-z0-9\-]/', '', $plagarism_output['File 2'][1]));
                                        }
                                    }
                                    $code_path->update(['plagiarism' => reset($user_code_matches)]);
                                }

                            }
                        }
                    }

                }
            }
        }
    }
}
