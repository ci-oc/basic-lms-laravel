<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'duration', 'start_date', 'end_date', 'full_mark', 'solve_many', 'activate_plagiarism','share_results','plagiarism_percentage','share_plagiarism','checked_for_plagiarism','results_details_w_respect_t_time'];

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

    public static function calculateDuration($quiz_duration, $solved_quiz_updated_at)
    {
        $exploded_timestamp = explode(' ', $solved_quiz_updated_at);
        $created_at_time = explode(':', $exploded_timestamp[1]);
        $quiz_duration_exploded = explode(':', $quiz_duration);
        $h = intval($quiz_duration_exploded[0]) + intval($created_at_time[0]);
        $i = intval($quiz_duration_exploded[1]) + intval($created_at_time[1]);
        $s = intval($quiz_duration_exploded[2]) + intval($created_at_time[2]);
        $date = explode('-', $exploded_timestamp[0]);
        $y = $date[0];
        $m = $date[1];
        $d = $date[2];
        $duration = date("Y-m-d H:i:s", mktime($h, $i, $s, $m, $d, $y));

        return $duration;
    }
}
