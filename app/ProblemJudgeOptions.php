<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemJudgeOptions extends Model
{
    public $table = 'problem_judge_options';
    protected $fillable = ['problem_id', 'judge_id'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
