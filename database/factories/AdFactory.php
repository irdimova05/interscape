<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->text,
            'salary' => $this->faker->numberBetween(1000, 10000),
            'ad_status_id' => $this->faker->numberBetween(1, 3),
            'ad_category_id' => $this->faker->numberBetween(1, 7),
            'job_type_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
