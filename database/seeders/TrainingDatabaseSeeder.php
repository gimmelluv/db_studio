<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Обновлённый сидер
    public function run(): void
    {
        // Пользователи
        DB::connection('training_sqlite')->table('users')->insert([
            ['name' => 'Alice', 'email' => 'alice@example.com', 'age' => 25, 'city' => 'New York', 'joined_at' => '2022-01-15'],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'age' => 30, 'city' => 'London', 'joined_at' => '2021-11-05'],
            ['name' => 'Charlie', 'email' => 'charlie@example.com', 'age' => 20, 'city' => 'Paris', 'joined_at' => '2023-03-20'],
            ['name' => 'David', 'email' => 'david@example.com', 'age' => 35, 'city' => 'Berlin', 'joined_at' => '2020-07-10'],
            ['name' => 'Eve', 'email' => 'eve@example.com', 'age' => 28, 'city' => 'Tokyo', 'joined_at' => '2023-01-01'],
        ]);

        // Продукты
        DB::connection('training_sqlite')->table('products')->insert([
            ['name' => 'Laptop', 'price' => 999.99, 'stock' => 15, 'category' => 'Electronics'],
            ['name' => 'Smartphone', 'price' => 699.99, 'stock' => 30, 'category' => 'Electronics'],
            ['name' => 'Headphones', 'price' => 149.99, 'stock' => 50, 'category' => 'Electronics'],
            ['name' => 'T-Shirt', 'price' => 19.99, 'stock' => 100, 'category' => 'Clothing'],
            ['name' => 'Jeans', 'price' => 49.99, 'stock' => 75, 'category' => 'Clothing'],
        ]);

        // Заказы
        DB::connection('training_sqlite')->table('orders')->insert([
            ['user_id' => 1, 'product_name' => 'Laptop', 'amount' => 999.99, 'order_date' => '2023-01-20', 'status' => 'completed'],
            ['user_id' => 2, 'product_name' => 'Smartphone', 'amount' => 699.99, 'order_date' => '2023-02-15', 'status' => 'completed'],
            ['user_id' => 3, 'product_name' => 'Headphones', 'amount' => 149.99, 'order_date' => '2023-03-10', 'status' => 'pending'],
            ['user_id' => 1, 'product_name' => 'T-Shirt', 'amount' => 19.99, 'order_date' => '2023-03-25', 'status' => 'completed'],
            ['user_id' => 4, 'product_name' => 'Jeans', 'amount' => 49.99, 'order_date' => '2023-04-05', 'status' => 'cancelled'],
            ['user_id' => 5, 'product_name' => 'Smartphone', 'amount' => 699.99, 'order_date' => '2023-04-10', 'status' => 'completed'],
        ]);
    }
}
