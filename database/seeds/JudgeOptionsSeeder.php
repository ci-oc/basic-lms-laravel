<?php

use Illuminate\Database\Seeder;
use App\JudgeOptions;

class JudgeOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $judge_options = [[
            'description' => 'i'
        ],
            [
                'description' => 'w'
            ],
            [
                'description' => 'b'
            ],
            [
                'description' => 'B'
            ],
            [
                'description' => 'Z'
            ],
            [
                'description' => 'E'
            ],
            [
                'description' => 'SJ'
            ],
        ];
        foreach ($judge_options as $key => $value) {
            JudgeOptions::create($value);
        }
    }
}
