<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Privilege;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
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
            'id_group' => 1,
            'id_privilege' => 1,
            'status' => 1,
        ]);

        User::create([
            'name' => 'Putri Dwi',
            'email' => 'putri@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'id_group' => 1,
            'id_privilege' => 1,
            'status' => 1,
        ]);

        Group::create([
            'name_group' => 'GLOBAL ADMIN'
        ]);

        Privilege::create([
            'name_privilege' => 'Administrator',
            'id_group' => 1,
        ]);

        Permission::create([
            'name_permission' => 'Administrator Menu',
        ]);
        Permission::create([
            'name_permission' => 'View User Menu',
        ]);
        Permission::create([
            'name_permission' => 'Create User',
        ]);
        Permission::create([
            'name_permission' => 'Delete User',
        ]);
        Permission::create([
            'name_permission' => 'View Privilege Menu',
        ]);
        Permission::create([
            'name_permission' => 'Create Privilege',
        ]);
        Permission::create([
            'name_permission' => 'Delete Privilege',
        ]);
        Permission::create([
            'name_permission' => 'View Group Menu',
        ]);
        Permission::create([
            'name_permission' => 'Create Group',
        ]);
        Permission::create([
            'name_permission' => 'Delete Group',
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 1, 
            'id_privilege' => 1,
        ]);
        
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 2, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 3, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 4, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 5, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 6, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 7, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 8, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 9, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 10, 
            'id_privilege' => 1,
        ]);

    }
}
