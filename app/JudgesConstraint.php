<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgesConstraint extends Model
{
    protected $fillable = ['max_mem_limit', 'max_time_limit'];
}
