<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCommodityStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_commodity_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('year')->comment('年份');
            $table->integer('article_type_id')->unsigned()->comment('商品类型');
            $table->foreign('commodity_id')->references('id')->on('commodities');
            $table->integer('count')->unsigned()->default(0)->comment('计数');

            $table->index('customer_id');
            $table->index('commodity_id');
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
        Schema::table('customer_commodity_statistics', function (Blueprint $table) {
            $table->dropForeign('customer_commodity_statistics_customer_id_foreign');
            $table->dropForeign('customer_commodity_statistics_commodity_id_foreign');
            $table->dropIndex('customer_id');
            $table->dropIndex('commodity_id');
        });
        Schema::drop('customer_commodity_statistics');
    }
}
