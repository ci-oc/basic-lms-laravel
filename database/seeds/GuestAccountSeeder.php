<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class GuestAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = ['name' => 'Guest',
            'email' => 'guest@guest.x',
            'password' => Hash::make('secret')];
        $u = User::create($account);
        $role_id = Role::where('name', '=', 'guest')->pluck('id')->first();
        $u->attachRole($role_id);
        $u->college_id = str_random(10);
    }
}
