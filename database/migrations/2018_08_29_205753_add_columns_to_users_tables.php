<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // ユーザー情報で入学年度/大学を追加
            $table->integer('admission_year')->nullable()->after('birth_day');
            $table->integer('university_id')->unsigned()->index()->nullable()->after('id');

            // 外部キー制約
            $table->foreign('university_id')->references('id')->on('universities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // rollback の設定
            $table->dropColumn('admission_year');
            $table->dropColumn('university_id');
        });
    }
}
