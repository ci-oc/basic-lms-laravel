<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'duration', 'start_date', 'end_date', 'full_mark', 'solve_many'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }

    public function solutions()
    {
        return $this->hasMany(UsersQuiz::class, 'quiz_id');
    }

    public static function isAvailable($start, $end)
    {
        date_default_timezone_set('Africa/Cairo');
        $QzStart = date("Y-m-d H:i:s", strtotime($start));
        $QzEnd = date("Y-m-d H:i:s", strtotime($end));
        $Now = Carbon::now();
        $available = false;
        if ($QzStart < $Now && $Now < $QzEnd) {
            $available = true;
        }
        return $available;
    }

    public static function hasFinished($end)
    {
        date_default_timezone_set('Africa/Cairo');
        $QzEnd = date("Y-m-d H:i:s", strtotime($end));
        $Now = Carbon::now();
        return $Now < $QzEnd ? false : true;

    }
}
