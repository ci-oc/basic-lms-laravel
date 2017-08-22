<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        ];
        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
