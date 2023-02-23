<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
