<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id', 'fk_256_quiz_quiz_id_question')->references('id')->on('quizzes')->onDelete('cascade');
            $table->text('question_text')->nullable();
            $table->text('code_snippet')->nullable();
            $table->text('answer_explanation')->nullable();
            $table->string('more_info_link')->nullable();
            $table->string('input_format')->nullable();
            $table->string('output_format')->nullable();
            $table->float('grade');
            $table->float('time_limit')->nullable();;
            $table->integer('mem_limit')->nullable();;
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
}
