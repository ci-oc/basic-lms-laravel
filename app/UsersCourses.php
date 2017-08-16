<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCourses extends Model
{
    //
    public $table = 'user_courses';
    protected $fillable = ['user_id', 'course_id'];
}
