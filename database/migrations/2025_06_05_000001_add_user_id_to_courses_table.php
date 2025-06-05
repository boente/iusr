<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained();
        });

        $superAdmin = User::role('Super Admin')->first();
        if ($superAdmin) {
            \DB::table('courses')->whereNull('user_id')->update(['user_id' => $superAdmin->id]);
        }

        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
