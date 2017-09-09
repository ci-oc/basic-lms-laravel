<?php

use Illuminate\Database\Seeder;
use App\SecurityQuestion;
class SecurityQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $security_questions = [
            [
                'question_text' => 'What was the name of the hospital where you were born?',
                'answer' => 'dummy1',
            ],
            [
                'question_text' => 'What school did you attend for sixth grade?',
                'answer' => 'dummy2'
            ],
            [
                'question_text' => 'In what town was your first job?',
                'answer' => 'dummy3'
            ]
        ];
        foreach ($security_questions as $key => $value) {
            SecurityQuestion::create($value);
        }
    }
}
