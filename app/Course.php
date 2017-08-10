<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = ['access_code', 'title', 'description'];

    public function instructor()
    {
        return $this->belongsToMany('App\User', 'instructors_courses', 'instructor_id', 'course_id');
    }
}
