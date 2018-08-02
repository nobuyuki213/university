<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // フリガナと生年月日を追加
            $table->string('name_phonetic')->nullable()->after('name');
            $table->integer('birth_year')->nullable()->after('name_phonetic');
            $table->integer('birth_month')->nullable()->after('birth_year');
            $table->integer('birth_day')->nullable()->after('birth_month');
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
            $table->dropColumn('name_phonetic');
            $table->dropColumn('birth_year');
            $table->dropColumn('birth_month');
            $table->dropColumn('birth_day');
        });
    }
}
