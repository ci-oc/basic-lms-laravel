<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgeOptions extends Model
{
    public $table = 'judge_options';
    protected $fillable = ['description'];
    public function problems()
    {
        return $this->belongsToMany('App\Problem', 'problem_judge_options','problem_id','judge_id')
            ->withTimestamps();
    }
}
