<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'en_name' => 'Administrator',
            'fr_name' => 'Administrateur',
        ]);
        Role::create([
            'en_name' => 'Company',
            'fr_name' => 'Entreprise',
        ]);
        Role::create([
            'en_name' => 'Student',
            'fr_name' => 'Étudiant',
        ]);
        Role::create([
            'en_name' => 'Pupil',
            'fr_name' => 'Élève',
        ]);
        Role::create([
            'en_name' => 'Unemployed',
            'fr_name' => 'Sans emploi fixe',
        ]);
    }
}
