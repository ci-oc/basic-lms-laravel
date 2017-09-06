<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemJudgeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_judge_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('problem_id')->unsigned()->nullable();
            $table->foreign('problem_id', 'fk_256_problem_problem_id_judge_problem')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('judge_id')->unsigned()->nullable();
            $table->foreign('judge_id', 'fk_256_judge_judge_id_judge_problem')->references('id')->on('judge_options')->onDelete('cascade');
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
        Schema::dropIfExists('problem_judge_options');
    }
}
