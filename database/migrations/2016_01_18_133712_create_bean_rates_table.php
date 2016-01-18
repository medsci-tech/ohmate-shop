<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeanRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bean_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->comment('项目');
            $table->foreign('project_id')->references('id')->on('projects');

            $table->string('action_en', 31)->comment('操作en');
            $table->string('action_ch', 31)->comment('操作ch');
            $table->double('rate', 15, 2)->nullable()->default(0)->comment('操作<->积分兑换率');

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
        Schema::table('bean_rates', function (Blueprint $table) {
            $table->dropForeign('bean_rates_project_id_foreign');
        });
        Schema::drop('bean_rates');
    }
}
