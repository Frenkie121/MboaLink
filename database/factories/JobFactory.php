<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sub_category_id' => SubCategory::factory(),
            'company_id' => Company::factory(),
            'title' => fake()->jobTitle(),
            'location' => fake('it_IT')->city(),
            'description' => fake()->paragraph(5),
            'salary' => fake()->numberBetween(10000, 20000).' - '.fake()->numberBetween(25000, 50000),
            'type' => fake()->numberBetween(1, 5),
            'dateline' => now()->addDays(fake()->numberBetween(4, 30)),
            'published_at' => fake()->randomElement([now(), null]),
        ];
    }
}
