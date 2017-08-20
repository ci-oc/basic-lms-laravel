<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCourses extends Model
{
    //
    public $table = 'user_courses';
    protected $fillable = ['user_id', 'course_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
}
