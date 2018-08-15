<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('university_id')->unsigned()->index();
            $table->integer('faculty_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->string('name'); // 授業名
            $table->integer('school_year')->nullable(); // 学年
            $table->string('teacher_name')->nullable(); // 先生名
            $table->string('textbook_name')->nullable(); // 教科書名
            $table->boolean('is_intermediate_test')->default(false); // 中間テストの有無
            $table->integer('intermediate_level')->nullable(); // 中間テスト難易度
            $table->boolean('is_intermediate_report')->default(false); // 中間レポートの有無
            $table->boolean('is_final_test')->default(false); // 期末テストの有無
            $table->integer('final_level')->nullable(); // 期末テスト難易度
            $table->boolean('is_final_report')->default(false); // 期末レポートの有無
            $table->string('attend')->nullable(); // 出席
            $table->string('attendance_method')->nullable(); // 出席方法
            $table->string('test_range', 700)->nullable(); // テスト範囲(出題傾向)
            $table->string('remarks', 500)->nullable(); // 備考
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
        Schema::dropIfExists('lessons');
    }
}
