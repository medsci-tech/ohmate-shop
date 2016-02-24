<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('commodity_id');
            $table->string('image_url');
            $table->integer('priority')->default(0);

            $table->foreign('commodity_id')
                ->references('id')
                ->on('commodities');

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
        Schema::table('commodity_images', function (Blueprint $table) {
            $table->dropForeign('commodity_images_commodity_id_foreign');
        });
        Schema::drop('commodity_images');
    }
}
