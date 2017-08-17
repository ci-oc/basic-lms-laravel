<?php

namespace App;

use App\Quiz;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question_text', 'code_snippet', 'answer_explanation',
        'more_info_link', 'input_format', 'output_format', 'grade'];

    public function setQuizIdAttribute($input)
    {
        $this->attributes['quiz_id'] = $input ? $input : null;
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionsOption::class, 'question_id');
    }

    public function testcases()
    {
        return $this->hasMany(TestsCase::class, 'question_id');
    }

    public function judge_options()
    {
        return $this->hasMany(ProblemJudgeOptions::class, 'problem_id');
    }

    public static function separateQuestionTypes($collections, $type)
    {
        $type_questions = array();
        foreach ($collections as $collection) {
            foreach ($collection as $question) {
                if ($type == 'MCQ') {
                    if ($question['input_format'] == null) {
                        $type_questions[] = $question;
                    }
                } else {
                    if ($question['input_format'] !== null) {
                        $type_questions[] = $question;
                    }
                }
            }
        }
        return $type_questions;
    }
}
