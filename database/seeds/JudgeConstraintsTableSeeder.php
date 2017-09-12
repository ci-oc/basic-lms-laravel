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

                'max_time_limit' => 1,
                'max_mem_limit' => 15360
            ],
        ];
        foreach ($judge_constraints as $key => $value) {
            JudgesConstraint::create($value);
        }
    }
}
