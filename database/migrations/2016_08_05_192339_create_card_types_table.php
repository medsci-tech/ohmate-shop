<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->unsignedInteger('beans_value');
            $table->integer('storage');

            $table->timestamps();
        });

        Schema::table('shop_card_applications', function (Blueprint $table) {
            $table->unsignedInteger('card_type_id')->after('id');
            $table->foreign('card_type_id')->references('id')->on('card_types');
        });

        Schema::table('shop_cards', function (Blueprint $table) {
            $table->unsignedInteger('card_type_id')->after('id');
            $table->foreign('card_type_id')->references('id')->on('card_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_card_applications', function (Blueprint $table) {
            $table->dropForeign('shop_card_applications_card_type_id_foreign');
            $table->dropColumn('card_type_id');
        });

        Schema::table('shop_cards', function (Blueprint $table) {
            $table->dropForeign('shop_cards_card_type_id_foreign');
            $table->dropColumn('card_type_id');
        });

        Schema::drop('card_types');
    }
}
