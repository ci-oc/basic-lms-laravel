<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlagiarismResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plagiarism_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_quiz_id')->unsigned()->nullable();
            $table->foreign('user_quiz_id', 'fk_256_user_quiz_id_quiz')->references('id')->on('quizzes')->onDelete('cascade');
            $table->integer('user_problem_id')->unsigned()->nullable();
            $table->foreign('user_problem_id', 'fk_256_user_problem_id_problem')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('user_1_id')->unsigned()->nullable();
            $table->foreign('user_1_id', 'fk_256_user_user1_id_testcase')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('plagiarism_percentage_1', 5, 2)->nullable();
            $table->integer('user_2_id')->unsigned()->nullable();
            $table->foreign('user_2_id', 'fk_256_user_user2_id_testcase')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('plagiarism_percentage_2', 5, 2)->nullable();
            $table->integer('lines_matched');
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
        Schema::dropIfExists('plagiarism_results');
    }
}
