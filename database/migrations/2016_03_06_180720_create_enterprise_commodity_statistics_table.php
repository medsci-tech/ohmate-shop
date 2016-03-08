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
            $table->increments('id');

            $table->date('date')->comment('����');

            $table->integer('commodity_id')->unsigned()->comment('��Ʒ����');
            $table->foreign('commodity_id')->references('id')->on('commodities');
            $table->integer('count')->unsigned()->default(0)->comment('����');

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
