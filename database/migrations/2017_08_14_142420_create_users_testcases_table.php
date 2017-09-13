<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTestcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_testcase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id', 'fk_256_solve_quiz_id_testcase')->references('id')->on('quizzes')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_256_user_user_id_testcase')->references('id')->on('users')->onDelete('cascade');
            $table->integer('problem_id')->unsigned()->nullable();
            $table->foreign('problem_id', 'fk_256_problem_problem_id_testcase')->references('id')->on('user_problem')->onDelete('cascade');
            $table->integer('testcase_id')->unsigned()->nullable();
            $table->foreign('testcase_id', 'fk_256_user_testcase_id_user')->references('id')->on('tests_cases')->onDelete('cascade');
            $table->tinyInteger('correct')->nullable()->default(0);
            $table->string('output');
            $table->string('cpu_usage');
            $table->string('vsize');
            $table->string('rss');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_testcase');
    }
}
