<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'course_material';
    protected $fillable = ['course_id','material_path','material_name'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
