<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SecurityQuestionTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(JudgeOptionsSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(SuperUserTableSeeder::class);
        $this->call(SecurityURLSeeder::class);
        $this->call(GuestAccountSeeder::class);
        $this->call(InstructorsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(CodingLanguagesSeeder::class);
        $this->call(JudgeConstraintsTableSeeder::class);

    }
}
