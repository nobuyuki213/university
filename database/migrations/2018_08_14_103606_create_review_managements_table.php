<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_id')->unsigned()->index(); // ・「どの口コミ」を
            $table->datetime('approved_date')->nullable(); //・「いつ（承認された日）」
            $table->boolean('is_approved')->default('0'); //・「承認したか（承認フラグ）」
            $table->string('approved_admin')->nullable(); //（・複数管理者であれば、「承認処理したのはどの管理者」）
            $table->datetime('points_date')->nullable(); //・「いつ（ポイント付与された日）」
            $table->integer('points')->nullable(); // ・「何ポイント付与した（ポイント数）」
            $table->string('granted_admin')->nullable(); // （・複数管理者であれば、「ポイント付与したのはどの管理者」）
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
        Schema::dropIfExists('review_managements');
    }
}
