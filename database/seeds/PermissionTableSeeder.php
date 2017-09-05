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
                'name' => 'update-administration-url',
                'display_name' => 'Update Administration URL',
                'description' => 'Privilege to generate a new URL to access administration panel'
            ],
            [
                'name' => 'security-questions-read',
                'display_name' => 'Display Security Questions Listing',
                'description' => 'See only Listing Of Security Questions'
            ],
            [
                'name' => 'security-questions-create',
                'display_name' => 'Create Security Question',
                'description' => 'Create New Security Question'
            ],
            [
                'name' => 'security-questions-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Security Question'
            ],
            [
                'name' => 'security-questions-delete',
                'display_name' => 'Delete Security Question',
                'description' => 'Delete Security Question'
            ],
            [
                'name' => 'create-course',
                'display_name' => 'Create Course',
                'description' => 'Access to create a new course'
            ],
            [
                'name' => 'edit-course',
                'display_name' => 'Edit Course',
                'description' => 'Access to edit an existing course'
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
                'name' => 'delete-quiz',
                'display_name' => 'Create Quiz',
                'description' => 'Access to create a new quiz'
            ],
            [
                'name' => 'edit-quiz',
                'display_name' => 'Edit Quiz',
                'description' => 'Access to edit quiz'
            ],
            [
                'name' => 'add-students',
                'display_name' => 'Add Students',
                'description' => 'Privilege to add new students.'
            ],
            [
                'name' => 'show-quiz-statistics',
                'display_name' => 'Show Quiz Statistics',
                'description' => 'Privilege to show statistics of a specific quiz.'
            ],
            [
                'name' => 'show-quiz-results',
                'display_name' => 'Show Quiz Results',
                'description' => 'Privilege to show results of a specific quiz.'
            ],
            [
                'name' => 'join-course',
                'display_name' => 'Join Course',
                'description' => 'Access to join existing course.'
            ],
            [
                'name' => 'add-news',
                'display_name' => 'Add News',
                'description' => 'Privilege to post news'
            ],
            [
                'name' => 'solve-quiz',
                'display_name' => 'Solve Quiz',
                'description' => 'Access to solve quiz for existing course.'
            ],
            [
                'name' => 'add-announcement',
                'display_name' => 'Add Announcement',
                'description' => 'Privilege to add announcements to students'
            ],

        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
