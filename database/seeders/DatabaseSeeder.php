<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Privilege;
use App\Models\Permission;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

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
            'email' => 'esa.hypernet@gmail.com',
            'password' => bcrypt('1q2w3e4r'),
            'id_group' => 1,
            'id_privilege' => 1,
            'status' => 1,
        ]);


        Group::create([
            'name_group' => 'GLOBAL ADMIN',
            'id' => 1
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
        Permission::create([
            'name_permission' => 'Edit User',
        ]);
        Permission::create([
            'name_permission' => 'Reset User',
        ]);
        Permission::create([
            'name_permission' => 'Edit Privilege',
        ]);
        Permission::create([
            'name_permission' => 'View Log',
        ]);
        Permission::create([
            'id' => '50',
            'name_permission' => 'View Nas Menu',
        ]);
        Permission::create([
            'id' => '51',
            'name_permission' => 'View Nas Routers',
        ]);
        Permission::create([
            'id' => '52',
            'name_permission' => 'Full Access Nas Routers',
        ]);
        Permission::create([
            'id' => '53',
            'name_permission' => 'View Nas Attributes',
        ]);
        Permission::create([
            'id' => '54',
            'name_permission' => 'Full Access Nas Attributes',
        ]);
        Permission::create([
            'id' => '55',
            'name_permission' => 'View Nas Users',
        ]);
        Permission::create([
            'id' => '56',
            'name_permission' => 'Full Access Nas Users',
        ]);
        Permission::create([
            'id' => '57',
            'name_permission' => 'Disable Enable Nas Users',
        ]);
        Permission::create([
            'id' => '58',
            'name_permission' => 'View Nas Profiles',
        ]);
        Permission::create([
            'id' => '59',
            'name_permission' => 'Full Access Nas Profiles',
        ]);

        Permission::create([
            'id' => '60',
            'name_permission' => 'View Services',
        ]);

        Permission::create([
            'id' => '61',
            'name_permission' => 'View Domain Management',
        ]);

        Permission::create([
            'id' => '62',
            'name_permission' => 'Full Access Domain Management',
        ]);

        Permission::create([
            'id' => '63',
            'name_permission' => 'View BWM',
        ]);

        Permission::create([
            'id' => '64',
            'name_permission' => 'Full Access BWM',
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
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 11, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 12, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 13, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 14, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 50, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 51, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 52, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 53, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 54, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 55, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 56, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 57, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 58, 
            'id_privilege' => 1,
        ]);
        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 59, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 60, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 61, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 62, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 63, 
            'id_privilege' => 1,
        ]);

        DB::table('table_privilege_permissions')->insert([
            'id_permission' => 64, 
            'id_privilege' => 1,
        ]);

    }
}
