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
            //SECURITY PERMISSIONS
            [
                'name' => 'role-read',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role',
                'category' => 'security'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role',
                'category' => 'security'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role',
                'category' => 'security'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role',
                'category' => 'security'
            ],
            [
                'name' => 'user-role-read',
                'display_name' => 'Read User Role',
                'description' => 'Read Role',
                'category' => 'security'
            ],
            [
                'name' => 'user-role-edit',
                'display_name' => 'Edit User Role',
                'description' => 'Edit User Role',
                'category' => 'security'
            ],
            [
                'name' => 'update-administration-url',
                'display_name' => 'Update Administration URL',
                'description' => 'Privilege to generate a new URL to access administration panel',
                'category' => 'security'
            ],
            [
                'name' => 'security-questions-read',
                'display_name' => 'Display Security Questions Listing',
                'description' => 'See only Listing Of Security Questions',
                'category' => 'security'
            ],
            [
                'name' => 'security-questions-create',
                'display_name' => 'Create Security Question',
                'description' => 'Create New Security Question',
                'category' => 'security'
            ],
            [
                'name' => 'security-questions-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Security Question',
                'category' => 'security'
            ],
            [
                'name' => 'security-questions-delete',
                'display_name' => 'Delete Security Question',
                'description' => 'Delete Security Question',
                'category' => 'security'
            ],
            [
                'name' => 'add-news',
                'display_name' => 'Add News',
                'description' => 'Privilege to post news'
                , 'category' => 'security'
            ],
            //HIGH EDUCATIONAL PRIVILEGES
            [
                'name' => 'create-course',
                'display_name' => 'Create Course',
                'description' => 'Access to create a new course',
                'category' => 'hep'
            ],
            [
                'name' => 'edit-course',
                'display_name' => 'Edit Course',
                'description' => 'Access to edit an existing course',
                'category' => 'hep'
            ],
            [
                'name' => 'drop-course',
                'display_name' => 'Drop Course',
                'description' => 'Access to drop existing course',
                'category' => 'hep'
            ],
            [
                'name' => 'create-quiz',
                'display_name' => 'Create Quiz',
                'description' => 'Access to create a new quiz',
                'category' => 'hep'
            ],
            [
                'name' => 'delete-quiz',
                'display_name' => 'Create Quiz',
                'description' => 'Access to create a new quiz',
                'category' => 'hep'
            ],
            [
                'name' => 'edit-quiz',
                'display_name' => 'Edit Quiz',
                'description' => 'Access to edit quiz',
                'category' => 'hep'
            ],
            [
                'name' => 'add-students',
                'display_name' => 'Add Students',
                'description' => 'Privilege to add new students.',
                'category' => 'hep'
            ],
            [
                'name' => 'show-quiz-statistics',
                'display_name' => 'Show Quiz Statistics',
                'description' => 'Privilege to show statistics of a specific quiz.',
                'category' => 'hep'
            ],
            [
                'name' => 'show-quiz-results',
                'display_name' => 'Show Quiz Results',
                'description' => 'Privilege to show results of a specific quiz.',
                'category' => 'hep'
            ],
            [
                'name' => 'add-announcement',
                'display_name' => 'Add Announcement',
                'description' => 'Privilege to add announcements to students',
                'category' => 'hep'
            ],
            //LOW EDUCATIONAL PRIVILEGES
            [
                'name' => 'view-course',
                'display_name' => 'View Courses List',
                'description' => 'View Courses List',
                'category' => 'lep'
            ],
            [
                'name' => 'join-course',
                'display_name' => 'Join Course',
                'description' => 'Access to join existing course.',
                'category' => 'lep'
            ],
            [
                'name' => 'solve-quiz',
                'display_name' => 'Solve Quiz',
                'description' => 'Access to solve quiz for existing course.',
                'category' => 'lep'
            ],
            [
                'name' => 'view-announcement',
                'display_name' => 'View Announcement',
                'description' => 'View Announcement',
                'category' => 'lep'
            ],
            //other
            [
                'name' => 'edit-profile',
                'display_name' => 'Edit Profile',
                'description' => 'Edit Profile',
                'category' => 'other'
            ],


        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
