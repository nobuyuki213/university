<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLessonToUniversityReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('university_review', function (Blueprint $table) {
            // 授業カラムの追加設定
            $table->string('lesson')->after('course')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('university_review', function (Blueprint $table) {
            // ロールバック時の設定
            $table->dropColumn('lesson');
        });
    }
}
