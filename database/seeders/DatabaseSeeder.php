<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'role_id' => 1,
            'name' => 'Admin MboaLink',
            'email' => 'admin@mboalink.com',
            'is_active' => true,
        ]);

        \App\Models\User::factory(4)->create();

        Category::factory(10)
                ->hasSubCategories(3)
                ->create();

        Tag::factory(5)->create();

        Job::factory()
            ->count(20)
            ->has(Tag::factory(fake()->numberBetween(1, 3)))
            ->create();
    }
}
