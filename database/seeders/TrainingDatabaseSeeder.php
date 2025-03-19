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
    public function run(): void
    {
        // Подключение к учебной базе данных
        DB::connection('training_sqlite')->table('users')->insert([
            ['name' => 'Alice', 'age' => 25],
            ['name' => 'Bob', 'age' => 30],
            ['name' => 'Charlie', 'age' => 20],
        ]);

        DB::connection('training_sqlite')->table('orders')->insert([
            ['user_id' => 1, 'amount' => 100.50],
            ['user_id' => 2, 'amount' => 200.75],
            ['user_id' => 3, 'amount' => 150.00],
        ]);
    }
}
