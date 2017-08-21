<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProblemAnswer extends Model
{
    public $table = 'user_problem';
    protected $fillable = ['problem_id', 'user_id', 'quiz_id', 'user_code', 'plagiarism', 'grade'];

    public function problem()
    {
        return $this->belongsTo('App\Question', 'problem_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
