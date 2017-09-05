<?php

use Illuminate\Database\Seeder;
use App\Url;

class SecurityURLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = str_random(250);
        Url::create(['url' => $url]);
    }
}
