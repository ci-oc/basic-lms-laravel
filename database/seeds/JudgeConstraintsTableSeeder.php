<?php

use Illuminate\Database\Seeder;
use App\JudgesConstraint;

class JudgeConstraintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $judge_constraints = [
            [

                'max_time_limit' => 60,
                'max_mem_limit' => 30720
            ],
        ];
        foreach ($judge_constraints as $key => $value) {
            JudgesConstraint::create($value);
        }
    }
}
