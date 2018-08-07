<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_content_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->string('feature', 500)->nullable();
            $table->timestamps();

            //外部キー制約
            $table->foreign('faculty_content_id')->references('id')->on('faculty_contents')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
}
