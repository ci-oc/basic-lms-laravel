<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlagiarismResult extends Model
{
    protected $fillable = ['user_quiz_id', 'user_problem_id', 'user_1_id', 'plagiarism_percentage_1', 'user_2_id', 'plagiarism_percentage_2', 'lines_matched'];
}
