<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->comment('类型');
            $table->foreign('type_id')->references('id')->on('video_types');

            $table->string('title')->comment('视频标题');
            $table->string('thumbnail')->comment('视频缩略图');
            $table->string('uri')->comment('视频uri');
            $table->integer('weight')->unsigned()->comment('权重');
            $table->integer('count')->unsigned()->comment('阅读量');
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
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('videos_type_id_foreign');
        });
        Schema::drop('videos');
    }
}
