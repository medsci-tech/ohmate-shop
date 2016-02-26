<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('remark');
            $table->text('introduction');
            $table->decimal('price');
            $table->timestamps();

        });

        Schema::create('commodity_order', function (Blueprint $table) {
            $table->unsignedInteger('commodity_id');
            $table->unsignedInteger('order_id');
            $table->integer('amount');

            $table->foreign('commodity_id')
                ->references('id')
                ->on('commodities');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');

            $table->primary(['commodity_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commodity_order', function (Blueprint $table) {
            $table->dropForeign('commodity_order_commodity_id_foreign');
            $table->dropForeign('commodity_order_order_id_foreign');
        });
        Schema::drop('commodity_order');
        Schema::drop('commodities');
    }
}
