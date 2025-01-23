<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jack Sleight',
            'email' => 'hi@jacksleight.com',
            'username' => 'jacksleight',
            'password' => bcrypt('password'),
        ]);

        $languages = [
            [
                'handle' => 'php',
                'name' => 'PHP',
            ],
            [
                'handle' => 'javascript',
                'name' => 'JavaScript',
            ],
            [
                'handle' => 'r',
                'name' => 'R',
            ],
        ];

        foreach ($languages as $language) {
            Language::create([
                'handle' => $language['handle'],
                'name' => $language['name'],
            ]);
        }

        $levels = [
            [
                'name' => 'Beginner',
            ],
            [
                'name' => 'Intermediate',
            ],
            [
                'name' => 'Advanced',
            ],
        ];

        foreach ($levels as $level) {
            Level::create([
                'name' => $level['name'],
            ]);
        }
    }
}
