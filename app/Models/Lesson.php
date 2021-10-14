<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function studio()
    {
        return $this->belongsTo('App\Models\Studio');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor');
    }
}
