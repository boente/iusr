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
                'name' => 'PHP',
                'editor_language' => 'php',
                'data' => [
                    'judge0_id' => 98,
                ],
            ],
            [
                'name' => 'JavaScript',
                'editor_language' => 'javascript',
                'data' => [
                    'judge0_id' => 102,
                ],
            ],
            [
                'name' => 'R',
                'editor_language' => 'r',
                'data' => [
                    'judge0_id' => 99,
                ],
            ],
        ];

        foreach ($languages as $language) {
            Language::create($language);
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
            Level::create($level);
        }
    }
}
