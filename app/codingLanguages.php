<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codingLanguages extends Model
{
    protected $table = 'coding_languages';
    protected $fillable = ['name', 'compile_name'];
}
