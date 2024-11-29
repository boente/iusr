<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'skill_level',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
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
