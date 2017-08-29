<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProblemAnswer extends Model
{
    public $table = 'user_problem';
    protected $fillable = ['problem_id', 'user_id', 'quiz_id', 'user_code', 'plagiarism', 'grade', 'compile_status',
        'run_status', 'compile_err_reason', 'time_consumed', 'code_language', 'user_code_path'];

    public function problem()
    {
        return $this->belongsTo('App\Question', 'problem_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\UsersQuiz', 'quiz_id');
    }
    public function solvedTestCases()
    {
        return $this->hasMany('App\UsersTestCaseAnswer', 'problem_id');
    }

}
