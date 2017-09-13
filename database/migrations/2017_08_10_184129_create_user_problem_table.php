<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_problem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id', 'fk_256_solve_quiz_id_problem')->references('id')->on('quizzes')->onDelete('cascade');
            $table->integer('problem_id')->unsigned()->nullable();
            $table->foreign('problem_id', 'fk_256_problem_problem_id_problem')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_256_user_problem_id_user')->references('id')->on('users')->onDelete('cascade');
            $table->text('user_code')->nullable();
            $table->text('user_code_path')->nullable();
            $table->string('time_consumed');
            $table->string('code_language');
            $table->string('compile_status');
            $table->text('compile_err_reason')->nullable();
            $table->string('run_status');
            $table->decimal('plagiarism', 5, 2)->nullable();
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
        Schema::dropIfExists('user_problem');
    }
}
