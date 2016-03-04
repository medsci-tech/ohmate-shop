<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDailyStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_daily_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('date')->comment('日期');
            $table->integer('article_count')->unsigned()->default(0)->comment('阅读文章数');

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
        Schema::table('customer_daily_statistics', function (Blueprint $table) {
            $table->dropForeign('customer_daily_statistics_customer_id_foreign');
        });
        Schema::drop('customer_daily_statistics');

    }
}
