<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role-read',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'create-course',
                'display_name' => 'Create Course',
                'description' => 'Access to create a new course'
            ],
            [
                'name' => 'drop-course',
                'display_name' => 'Drop Course',
                'description' => 'Access to drop existing course'
            ],
            [
                'name' => 'create-quiz',
                'display_name' => 'Create Quiz',
                'description' => 'Access to create a new quiz'
            ],
            [
                'name' => 'edit-quiz',
                'display_name' => 'Edit Quiz',
                'description' => 'Access to edit quiz'
            ],
            [
                'name' => 'join-course',
                'display_name' => 'Join Course',
                'description' => 'Access to join existing course'
            ],
            [
                'name' => 'leave-course',
                'display_name' => 'Leave Course',
                'description' => 'Access to leave existing course'
            ],
            [
                'name' => 'solve-quiz',
                'display_name' => 'Solve Quiz',
                'description' => 'Access to solve quiz for existing course'
            ],


        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
