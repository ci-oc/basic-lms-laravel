<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuiz extends Model
{
    public $table = 'user_quiz';
    protected $fillable = ['quiz_id', 'user_id', 'grade','processing_status'];

    public function user()
    {
        return $this->belongsTo('App\User',  'user_id');
    }
    public function quiz()
    {
        return $this->belongsTo('App\Quiz',  'quiz_id');
    }
}
