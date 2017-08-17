<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgeOptions extends Model
{
    public $table = 'judge_options';
    protected $fillable = ['description'];
}
