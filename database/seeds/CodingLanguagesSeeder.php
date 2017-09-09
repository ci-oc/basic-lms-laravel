<?php

use Illuminate\Database\Seeder;
use App\codingLanguages;
class CodingLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coding_languages = [
            [

                'name' => 'GNU GCC',
                'compile_name' => 'c'
            ],
            [
                'name' => 'GNU G++',
                'compile_name' => 'cpp'
            ],
        ];
        foreach ($coding_languages as $key => $value) {
            codingLanguages::create($value);
        }
    }
}
