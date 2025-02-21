<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Privilege;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'id_company' => 1,
            'id_privilege' => 1,
            'status' => 1,
        ]);

        Company::create([
            'name_company' => 'GLOBAL ADMIN'
        ]);

        Privilege::create([
            'name_privilege' => 'Administrator',
            'id_company' => 1,
        ]);

        
    }
}
