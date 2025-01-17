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

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class);
    }
}
