<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_videos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned()->comment('用户ID');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('video_id')->unsigned()->comment('用户ID');
            $table->foreign('video_id')->references('id')->on('videos');

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
        Schema::table('favorite_videos', function (Blueprint $table) {
            //
            $table->dropForeign('favorite_videos_customer_id_foreign');
            $table->dropForeign('favorite_videos_video_id_foreign');
        });

        Schema::drop('favorite_videos');
    }
}
