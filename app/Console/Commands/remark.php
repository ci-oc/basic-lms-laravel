<?php

namespace App\Console\Commands;

use App\UsersProblemAnswer;
use Illuminate\Console\Command;
use App\Quiz;

class remark extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $quizzes = Quiz::all()->load('problems');
        foreach ($quizzes as $quiz) {
            if (Quiz::hasFinished($quiz->end_date)) {
                if (count($quiz->problems) > 0) {
                    $solved_problems = UsersProblemAnswer::where('quiz_id', '=', $quiz->id)->pluck('user_code');

                }
            }
        }
    }
}
