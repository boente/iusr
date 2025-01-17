<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Language extends Model
{
    use Sushi;

    protected $rows = [
        [
            'id' => 'javascript',
            'name' => 'JavaScript',
        ],
        [
            'id' => 'r',
            'name' => 'R',
        ],
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
