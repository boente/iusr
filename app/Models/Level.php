<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
