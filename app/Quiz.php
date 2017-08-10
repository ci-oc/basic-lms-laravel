<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable;

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id')->withTrashed();
    }

    public function problems()
    {
        return $this->hasMany(Question::class, 'quiz_id')->withTrashed();
    }
}
