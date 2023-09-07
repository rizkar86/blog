<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->name,
            'author' => $this->faker->name,
            'image' => $this->faker->imageUrl(),
            'short_content' => $this->faker->text,
            'content' => $this->faker->text,

        ];
    }
}
