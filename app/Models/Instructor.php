<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $guarded = [];

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
