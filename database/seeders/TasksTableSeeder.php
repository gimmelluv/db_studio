<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отключаем foreign key constraints для SQLite
        if (DB::connection()->getDriverName() === 'sqlite') {
            Schema::disableForeignKeyConstraints();
            DB::table('task_user')->truncate();
            DB::table('tasks')->truncate();
            Schema::enableForeignKeyConstraints();
        } else {
            // Для других СУБД
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('task_user')->truncate();
            DB::table('tasks')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $tasks = [
            [
                'id' => 1,
                'title' => 'Базовый SELECT',
                'description' => 'Выведите всех пользователей из таблицы users.',
                'solution' => 'SELECT * FROM users;',
                'check_query' => 'SELECT COUNT(*) as count FROM users;',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'title' => 'SELECT с условием',
                'description' => 'Выведите пользователей старше 25 лет.',
                'solution' => 'SELECT * FROM users WHERE age > 25;',
                'check_query' => 'SELECT COUNT(*) as count FROM users WHERE age > 25;',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Добавьте остальные задания...
        ];

        // Используем insert вместо create для сохранения указанных ID
        Task::insert($tasks);
    }
}
