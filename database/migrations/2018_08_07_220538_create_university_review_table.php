<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('university_id')->unsigned()->index();
            $table->integer('review_id')->unsigned()->index();
            $table->string('faculty')->index();
            $table->string('course')->nullable()->index();
            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities');
            $table->foreign('review_id')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('university_review');
    }
}
