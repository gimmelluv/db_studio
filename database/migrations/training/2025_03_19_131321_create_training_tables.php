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
        Schema::connection('training_sqlite')->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('age');
            $table->string('city');
            $table->date('joined_at');
            $table->timestamps();
        });

        Schema::connection('training_sqlite')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('product_name');
            $table->decimal('amount', 8, 2);
            $table->date('order_date');
            $table->string('status'); // 'pending', 'completed', 'cancelled'
            $table->timestamps();
        });

        Schema::connection('training_sqlite')->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tables');
    }
};
