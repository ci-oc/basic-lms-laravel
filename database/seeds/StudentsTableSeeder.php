<?php

use Illuminate\Database\Seeder;
use App\Role;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function ($u) {
            $role_id = Role::where('name', '=', 'student')->pluck('id')->first();
            $u->attachRole($role_id);
            $u->college_id = str_random(10);
            $u->save();
        });
    }
}
