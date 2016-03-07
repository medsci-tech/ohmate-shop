<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseCommodityStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_commodity_statistics', function (Blueprint $table) {

            $table->date('date')->comment('日期');

            $table->integer('commodity_id')->unsigned()->comment('商品类型');
            $table->foreign('commodity_id')->references('id')->on('commodities');
            $table->integer('count')->unsigned()->default(0)->comment('计数');

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
        Schema::table('enterprise_commodity_statistics', function (Blueprint $table) {
            $table->dropForeign('enterprise_commodity_statistics_commodity_id_foreign');
            $table->dropIndex('commodity_id');
        });
        Schema::drop('enterprise_commodity_statistics');

    }
}
