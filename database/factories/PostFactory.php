<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
    $title = $this->faker->sentence(6);
    return [
        'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
        'title' => $title,
        'slug' => \Illuminate\Support\Str::slug($title),
        'content' => $this->faker->paragraphs(3, true),
        'image' => null, // On laissera une image par défaut dans la vue pour les tests
        'is_published' => true,
    ];
}
}
