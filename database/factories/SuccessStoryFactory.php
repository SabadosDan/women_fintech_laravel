<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuccessStory>
 */
class SuccessStoryFactory extends Factory
{
    protected $model = \App\Models\SuccessStory::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'story' => $this->faker->paragraph,
            'member_id' => \App\Models\Member::inRandomOrder()->first()->id,
        ];
    }
}
