<?php

use Illuminate\Database\Seeder;
use App\Role;

class SuperUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 2)->create()->each(function ($u) {
            $role_id = Role::where('name', '=', 'superuser')->pluck('id')->first();

            $u->attachRole($role_id);
        });
    }
}
