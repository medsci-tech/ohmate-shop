<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRhMateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rh_mate_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->default(0)->comment('用户');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('head_image_url')->nullable()->comment('wechat headimgurl');
            $table->string('qr_code')->nullable()->comment('personal qr code');

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
        Schema::drop('rh_mate_customers');
    }
}
