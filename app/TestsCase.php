<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestsCase extends Model
{
    protected $fillable = ['question_id', 'input', 'output'];
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
}
