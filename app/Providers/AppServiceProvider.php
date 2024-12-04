<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict();
        Model::unguard();

        $this->bootSqliteOptimize();
    }

    protected function bootSqliteOptimize(): void
    {
        $db = DB::connection();

        if ($db->getDriverName() !== 'sqlite') {
            return;
        }

        $db->unprepared('PRAGMA synchronous = NORMAL;');
        $db->unprepared('PRAGMA foreign_keys = ON;');
        $db->unprepared('PRAGMA temp_store = MEMORY;');
        $db->unprepared('PRAGMA busy_timeout = 5000;');
        $db->unprepared('PRAGMA cache_size = 2000;');
    }
}
