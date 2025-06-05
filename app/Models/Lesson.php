<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order = static::max('order') + 1;
        });
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function steps()
    {
        return $this->hasMany(LessonStep::class)
            ->chaperone('lesson')
            ->orderBy('order')
            ->orderBy('id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
