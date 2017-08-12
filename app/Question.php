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
        return $this->hasMany(QuestionsOption::class, 'question_id')->withTrashed();
    }

    public function testcases()
    {
        return $this->hasMany(TestsCase::class, 'question_id')->withTrashed();
    }

    public static function separateQuestionTypes($quizzes, $type)
    {
        $type_questions = array();
        for ($k = 0; $k < count($quizzes); $k++) {
            for ($j = 0; $j < count($quizzes[$k]['questions']); $j++) {
                if ($type == 'MCQ') {
                    if ($quizzes[$k]['questions'][$j]['input_format'] == null) {
                        $type_questions[] = $quizzes[$k]['questions'][$j];

                    }
                } else {
                    if ($quizzes[$k]['questions'][$j]['input_format'] !== null) {
                        $type_questions[] = $quizzes[$k]['questions'][$j];
                    }
                }
            }
        }
        return $type_questions;
    }
}
