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
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('head_image_url')->nullable()->comment('wechat headimgurl');

            $table->string('phone', 31)->nullable()->comment('personal telephone');
            $table->string('auth_code', 11)->nullable()->comment('sms auth code');
            $table->string('qr_code')->nullable()->comment('personal qr code');

            $table->integer('referrer_id')->unsigned()->default(0)->commment('the customer id of referrer');
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
        Schema::table('oh_mate_customers', function (Blueprint $table) {
            $table->dropForeign('oh_mate_customers_customer_id_foreign');
        });
        Schema::drop('oh_mate_customers');
    }
}
