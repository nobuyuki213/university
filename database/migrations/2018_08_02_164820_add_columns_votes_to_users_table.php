<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsVotesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //仮会員登録で発行するURLtokenのフィールドを追加
            $table->tinyInteger('email_verified')->default(0); //認証済みかどうか
            $table->string('email_verify_token')->nullable(); //email用トークン
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
            // rollback用の設定
            $table->dropColumn('email_verified');
            $table->dropColumn('email_verify_token');
        });
    }
}
