<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson_steps', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->text('code')->nullable();
            $table->text('solution')->nullable();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
};
