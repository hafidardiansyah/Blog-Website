<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    // * App\Models\Post::factory()->count(25)->create();

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 3),
            'title' => $this->faker->sentence(),
            'slug' => Str::random(10),
            'body' => $this->faker->paragraph(10),
        ];
    }
}
