<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('university_id')->unsigned()->index();
            $table->integer('faculty_id')->unsigned()->index();
            $table->string('overview', 500)->nullable();
            $table->timestamps();

            // 外部キー制約
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_contents');
    }
}
