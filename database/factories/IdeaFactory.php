<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Idea::class;
    public function definition(): array
    {

        return [
            'user_id' => $this->faker->numberBetween(7,12),
            'content' => $this->faker->text(150),
            'created_at' => now(),
        ];
    }
}
