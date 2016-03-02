<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDailyArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_daily_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->date('date')->comment('日期');
            $table->double('value', 15, 2)->comment('单日学习获得迈豆总额');

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
        Schema::table('customer_daily_articles', function (Blueprint $table) {
            $table->dropForeign('customer_daily_articles_customer_id_foreign');
        });
        Schema::drop('customer_daily_articles');

    }
}