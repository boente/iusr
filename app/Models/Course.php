<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class);
    }

    public function getTimeToCompleteAttribute()
    {
        return $this->lessons->sum('time_to_complete');
    }
}
