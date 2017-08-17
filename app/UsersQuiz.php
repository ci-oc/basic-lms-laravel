<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuiz extends Model
{
    public $table = 'user_quiz';
    protected $fillable = ['quiz_id', 'user_id', 'grade'];

    public function users()
    {
        $this->belongsToMany('App\User', 'user_quiz', 'user_id', 'quiz_id');
    }
}
