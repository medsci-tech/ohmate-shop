<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseArticleStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_article_statistics', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date')->comment('����');

            $table->integer('article_type_id')->unsigned()->comment('��������');
            $table->foreign('article_type_id')->references('id')->on('article_types');
            $table->integer('count')->unsigned()->default(0)->comment('����');

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
        Schema::table('enterprise_article_statistics', function (Blueprint $table) {
            $table->dropForeign('enterprise_article_statistics_article_type_id_foreign');
        });
        Schema::drop('enterprise_article_statistics');
    }
}
