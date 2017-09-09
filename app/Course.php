<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = ['access_code', 'title', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_courses')
            ->withTimestamps();
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }

    public function material()
    {
        return $this->hasMany(Material::class, 'course_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'course_id');
    }

    public static function retrieveId($data)
    {
        $courses_id = array();
        for ($i = 0; $i < count($data); $i++) {
            $courses_id[$i] = $data[$i]->id;
        }
        return $courses_id;
    }
}
