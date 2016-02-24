<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });


        Schema::create('category_commodity', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('commodity_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('commodity_id')->references('id')->on('commodities');

            $table->primary(['category_id', 'commodity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_commodity', function (Blueprint $table) {
            $table->dropForeign('category_commodity_category_id_foreign');
            $table->dropForeign('category_commodity_commodity_id_foreign');
        });
        Schema::drop('category_commodity');
        Schema::drop('categories');
    }
}
