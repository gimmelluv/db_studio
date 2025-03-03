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
       Schema::create('diagrams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // Добавляем поле для хранения идентификатора пользователя
                  ->constrained() // Создаем внешний ключ, ссылающийся на таблицу users
                  ->onDelete('cascade'); // Удаляем диаграммы, если пользователь удален
            $table->string('type');
            $table->string('title');
            $table->text('description');
            $table->string('file_path');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagrams');
    }
};
