<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded = [];

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
