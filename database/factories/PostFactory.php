<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    
    protected $model = Post::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::get()->random()->id,
            'title'=>$this->faker->name(20),
            'description'=>$this->faker->text(80),
            'body'=>$this->faker->text,
            'image'=>$this->faker->imageUrl(),
        ];
    }
}
