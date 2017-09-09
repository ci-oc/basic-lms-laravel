<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_256_course_announcements_id_course')->references('id')->on('courses')->onDelete('cascade');;
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_256_user_announcements_id_user')->references('id')->on('users')->onDelete('cascade');;
            $table->text('announcement');
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
        Schema::dropIfExists('announcements');
    }
}
