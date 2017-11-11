<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superuser',
                'display_name' => 'Superuser',
                'description' => 'Access to create, edit, delete and read data.'
            ],
            [
                'name' => 'standard-user',
                'display_name' => 'Standard Superuser',
                'description' => 'Access to create, edit, delete and read data.'
            ],
            [
                'name' => 'instructor',
                'display_name' => 'Instructor',
                'description' => 'Instructor'
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Student'
            ],
            [
                'name' => 'guest',
                'display_name' => 'Guest',
                'description' => 'Guest account to view features.'
            ],
        ];
        foreach ($roles as $key => $value) {
            $role = Role::create($value);
            if ($role->name == 'superuser') {
                $permissions = Permission::where('category', '=', 'security')->get()->toArray();
                $role->attachPermissions($permissions);
            }
        }
    }
}
