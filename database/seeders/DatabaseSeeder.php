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
        $admin = User::create([
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
                'order' => 1,
            ],
            [
                'name' => 'Intermediate',
                'order' => 2,
            ],
            [
                'name' => 'Advanced',
                'order' => 3,
            ],
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }

        $this->call(ShieldSeeder::class);

        $admin->assignRole('Super Admin');
    }
}
