<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteEssaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_essays', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned()->comment('用户ID');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('essay_id')->unsigned()->comment('用户ID');
            $table->foreign('essay_id')->references('id')->on('essays');

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
        Schema::table('favorite_essays', function (Blueprint $table) {
            //
            $table->dropForeign('favorite_essays_customer_id_foreign');
            $table->dropForeign('favorite_essays_essay_id_foreign');
        });

        Schema::drop('favorite_essays');
    }
}
