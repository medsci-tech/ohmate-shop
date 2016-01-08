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
            $table->string('url')->comment('视频路径');
            $table->string('title')->comment('文章title');
            $table->integer('count')->unsigned()->nullable()->default(0)->comment('视频点击次数');
            $table->boolean('is_hot')->nullable()->default(false)->comment('是否为热门视频');
            $table->boolean('is_top')->nullable()->default(false)->comment('是否为置顶视频');
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
        Schema::drop('videos');
    }
}
