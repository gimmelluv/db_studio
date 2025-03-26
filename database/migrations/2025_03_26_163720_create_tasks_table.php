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
        // database/migrations/[...]_create_tasks_table.php
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('solution');
            $table->text('check_query');
            $table->string('difficulty')->default('beginner');
            $table->timestamps();
        });

        Schema::create('task_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->boolean('is_passed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
