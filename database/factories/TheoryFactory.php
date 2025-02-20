<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theory>
 */
class TheoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence, // Генерация случайного заголовка
            'subtitle' => $this->faker->sentence, // Генерация случайного подзаголовка
            'content' => $this->faker->paragraph, // Генерация случайного контента
        ];
    }
}
