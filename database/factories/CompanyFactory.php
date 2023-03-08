<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => fake('it_IT')->city(),
            'description' => fake()->paragraphs(2, true),
            'url' => fake()->url(),
            'logo' => fake()->imageUrl(),
        ];
    }
}
