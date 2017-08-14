<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTestCaseAnswer extends Model
{
    public $table = 'user_testcases';
    protected $fillable = ['user_id', 'problem_id', 'testcase_id', 'correct', 'output'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_testcases');
    }
}
