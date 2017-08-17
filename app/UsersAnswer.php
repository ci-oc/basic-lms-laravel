<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersAnswer extends Model
{
    public $table = 'user_question';
    protected $fillable = ['question_id', 'user_id', 'correct', 'option_id', 'grade'];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_question');
    }
}
