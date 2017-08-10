<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = ['access_code', 'title', 'description'];

    public function instructors()
    {
        return $this->belongsToMany('App\User', 'instructors_courses', 'course_id', 'instructor_id');
    }
}
