<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'security_url';
    protected $fillable = ['url'];
}
