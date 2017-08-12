<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'duration', 'start_date', 'end_date', 'full_mark'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }


    public static function filterByCourse($course_id, $courses)
    {
        $quizzes = array();
        foreach ($courses as $course) {
            foreach ($course_id as $id) {
                if ($course->course_id == $id) {
                    $quizzes[] = $course;
                }
            }
        }
        return $quizzes;
    }

}
