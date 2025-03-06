<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order = static::max('order') + 1;
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getTimeToCompleteAttribute()
    {
        return $this->lessons->sum('time_to_complete');
    }
}
