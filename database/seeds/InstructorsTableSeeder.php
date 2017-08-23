<?php

use Illuminate\Database\Seeder;
use App\Role;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function ($u) {
            $role_id = Role::where('name', '=', 'instructor')->pluck('id')->first();
            $u->attachRole($role_id);
        });
    }
}
