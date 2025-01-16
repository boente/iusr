<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function steps()
    {
        return $this->hasMany(LessonStep::class)->orderBy('order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
