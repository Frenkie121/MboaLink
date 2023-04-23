<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $free = Subscription::create([
            'name' => 'Free',
            'amount' => fake()->randomElement([1000, 2000, 3000, 5000]),
            'duration' => fake()->randomDigit(),
        ]);

        $enterprise = Subscription::create([
            'name' => 'Company',
            'amount' => fake()->randomElement([1000, 2000, 3000, 5000]),
            'duration' => fake()->randomDigit(),
        ]);

        $student = Subscription::create([
            'name' => 'Student',
            'amount' => fake()->randomElement([1000, 2000, 3000, 5000]),
            'duration' => fake()->randomDigit(),
        ]);

        $pupil = Subscription::create([
            'name' => 'Pupil',
            'amount' => fake()->randomElement([1000, 2000, 3000, 5000]),
            'duration' => fake()->randomDigit(),
        ]);

        $unemployed = Subscription::create([
            'name' => 'Unemployed',
            'amount' => fake()->randomElement([1000, 2000, 3000, 5000]),
            'duration' => fake()->randomDigit(),
        ]);

        for ($i=0; $i < 7; $i++) { 
            $free->offers()->create([
                'content' => fake()->sentence()
            ]);
            
            $enterprise->offers()->create([
                'content' => fake()->sentence()
            ]);
            
            $student->offers()->create([
                'content' => fake()->sentence()
            ]);
            
            $pupil->offers()->create([
                'content' => fake()->sentence()
            ]);

            $unemployed->offers()->create([
                'content' => fake()->sentence()
            ]);
        }
    }
}
