<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityQuestion extends Model
{
    protected $table = 'security_questions';
    protected $fillable = ['question_text','answer'];

}
