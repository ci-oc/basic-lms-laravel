<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id', 'fk_256_solve_quiz_id_question')->references('id')->on('quizzes');
            $table->integer('question_id')->unsigned()->nullable();
            $table->foreign('question_id', 'fk_256_question_question_id_question')->references('id')->on('questions')->onDelete('cascade');;
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_256_user_user_id_user')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('correct')->nullable()->default(0);
            $table->integer('option_id')->unsigned()->nullable();
            $table->foreign('option_id', 'fk_256_option_option_id_user')->references('id')->on('questions_options')->onDelete('cascade');
            $table->float('grade')->default(0.0);
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
        Schema::dropIfExists('user_question');
    }
}
