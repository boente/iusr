<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'description',
        'comparison_method',
        'type',
        'time_to_complete',
        'chapter_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function lessonSteps()
    {
        return $this->hasMany(LessonStep::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
