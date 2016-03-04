<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('friend_count')->unsigned()->default(0)->comment('好友数');
            $table->integer('article_count')->unsigned()->default(0)->comment('阅读数');
            $table->integer('commodity_count')->unsigned()->default(0)->comment('购买商品数');
            $table->integer('order_count')->unsigned()->default(0)->comment('订单数');

            $table->index('customer_id');
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
        Schema::table('customer_statistics', function (Blueprint $table) {
            $table->dropForeign('customer_statistics_customer_id_foreign');
            $table->dropIndex('customer_id');
        });
        Schema::drop('customer_statistics');

    }
}
