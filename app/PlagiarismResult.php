<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlagiarismResult extends Model
{
    protected $fillable = ['user_quiz_id', 'user_problem_id', 'user_1_id', 'plagiarism_percentage_1', 'user_2_id', 'plagiarism_percentage_2', 'lines_matched'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'user_quiz_id');
    }
    public function problem()
    {
        return $this->belongsTo('App\Question', 'user_problem_id');
    }
    public function user_1()
    {
        return $this->belongsTo('App\User',  'user_1_id');
    }
    public function user_2()
    {
        return $this->belongsTo('App\User',  'user_2_id');
    }
}
