<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id')->nullable();

            $table->foreign('customer_id')
                ->references('id')->on('customers');

            $table->string('number')->unique();
            $table->string('secret');
            $table->boolean('marked')->default(0);

            $table->timestamp('bought_at')->nullable();
            $table->timestamp('marked_at')->nullable();

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

        Schema::table('shop_cards', function (Blueprint $table) {
            $table->dropForeign('shop_cards_customer_id_foreign');
        });
        Schema::drop('shop_cards');
    }
}
