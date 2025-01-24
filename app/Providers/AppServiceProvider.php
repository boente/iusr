<?php

namespace App\Providers;

use App\Checkers\Checker;
use App\Executors\Executor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('executor', function (): Executor {
            $config = config('code.executors.'.config('code.executor'));
            $class = $config['class'];

            return new $class($config);
        });

        $this->app->singleton('checker', function (): Checker {
            $config = config('code.checker');
            $class = $config['class'];

            return new $class;
        });
    }

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
