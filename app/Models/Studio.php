<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $guarded = [];

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
