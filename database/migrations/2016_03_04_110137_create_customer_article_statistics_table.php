<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerArticleStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_article_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('article_type_id')->unsigned()->comment('文章类型');
            $table->foreign('article_type_id')->references('id')->on('article_types');
            $table->integer('count')->unsigned()->default(0)->comment('计数');

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
        Schema::table('customer_article_statistics', function (Blueprint $table) {
            $table->dropForeign('customer_article_statistics_customer_id_foreign');
            $table->dropForeign('customer_article_statistics_article_type_id_foreign');
        });
        Schema::drop('customer_article_statistics');

    }
}
