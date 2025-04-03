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
        Schema::table('tasks', function (Blueprint $table) {
            // Удаляем колонку, если она существует
            if (Schema::hasColumn('tasks', 'er_diagram')) {
                $table->dropColumn('er_diagram');
            }
            
            // Добавляем колонку правильно
            $table->string('er_diagram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
