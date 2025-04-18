<?php

namespace Database\Seeders;

use App\Models\Theory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theory::factory()->count(20)->create(); // Создает 10 записей теории
    }
}
