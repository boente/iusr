<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonStep extends Model
{
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getLanguageIdAttribute()
    {
        return $this->lesson->chapter->course->language_id;
    }

    public function getNumberAttribute()
    {
        return $this->lesson->steps->search($this) + 1;
    }
}
