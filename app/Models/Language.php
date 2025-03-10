<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $attributes = [
        'data' => '{}',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
