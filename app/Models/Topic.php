<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
