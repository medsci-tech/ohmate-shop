<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_en', 11)->comment('视频类型-英');
            $table->string('type_ch', 11)->comment('视频类型-中');
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
        Schema::drop('video_types');
    }
}
