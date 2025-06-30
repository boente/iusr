<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $db = DB::connection();

        if ($db->getDriverName() !== 'sqlite') {
            return;
        }

        $db->unprepared('PRAGMA journal_mode = WAL;');
    }
};
