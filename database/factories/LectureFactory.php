<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $article = $this->faker->paragraph();

        $title = implode(' ', array_slice(explode(' ', $article), 0, rand(1,3)));
        return [
            'title' => $title,
            'description' => $article
           ];

    }
}
