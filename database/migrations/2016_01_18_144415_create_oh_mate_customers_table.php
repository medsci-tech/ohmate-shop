<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOhMateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oh_mate_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->default(0)->comment('the customer id');
            $table->integer('referrer_id')->unsigned()->default(0)->commment('the customer id of referrer');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('head_image_url')->nullable()->comment('wechat headimgurl');

            $table->string('auth_code', 11)->nullable()->comment('sms auth code');
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
        Schema::drop('oh_mate_customers');
    }
}
