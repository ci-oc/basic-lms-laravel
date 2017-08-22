<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class UsersTestCaseAnswer extends Model
{
    public $table = 'user_testcase';
    protected $fillable = ['user_id', 'quiz_id', 'problem_id', 'testcase_id', 'correct', 'output', 'cpu_usage', 'vsize', 'rss'];

    public function question()
    {
        return $this->belongsTo('App\Question', 'problem_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function testcase()
    {
        return $this->belongsTo('App\TestsCase', 'testcase_id');
    }
    public function quiz()
    {
        return $this->belongsTo('App\User', 'quiz_id');
    }
}
