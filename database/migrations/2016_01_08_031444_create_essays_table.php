<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->comment('文章路径');
            $table->string('title')->comment('文章title');
            $table->integer('count')->unsigned()->nullable()->default(0)->comment('文章阅读次数');
            $table->boolean('is_hot')->nullable()->default(false)->comment('是否为热门文章');
            $table->boolean('is_top')->nullable()->default(false)->comment('是否为置顶文章');
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
        Schema::drop('essays');
    }
}
