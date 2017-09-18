<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_256_course_course_id_quiz')->references('id')->on('courses');
            $table->string('title');
            $table->text('description');
            $table->time('duration')->nullable();
            $table->tinyInteger('plagiarism_percentage')->nullable();
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->float('full_mark')->nullable();
            $table->tinyInteger('solve_many')->nullable()->default(0);
            $table->tinyInteger('activate_plagiarism')->nullable()->default(0);
            $table->tinyInteger('share_results')->nullable()->default(0);
            $table->tinyInteger('share_plagiarism')->nullable()->default(0);
            $table->tinyInteger('checked_for_plagiarism')->default(0);
            $table->tinyInteger('results_details_w_respect_t_time')->default(0);
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
        Schema::dropIfExists('quizzes');
    }
}
