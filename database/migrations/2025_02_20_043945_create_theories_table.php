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
        Schema::create('theories', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Заголовок
            $table->string('subtitle'); // Подзаголовок
            $table->text('content'); // Контент
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theories');
    }
};
