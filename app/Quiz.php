<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'duration', 'start_date', 'end_date', 'full_mark'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id')->withTrashed();
    }

    public function problems()
    {
        return $this->hasMany(Question::class, 'quiz_id')->withTrashed();
    }
}
