<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('phone', 31)->nullable()->comment('personal telephone');
            $table->string('auth_code', 11)->nullable()->comment('sms auth code');

            $table->integer('referrer_id')->unsigned()->nullable()->default(0)->commment('the customer id of referrer');
            $table->string('qr_code')->nullable()->comment('personal qr code');

            $table->boolean('is_registered')->nullable()->default(false)->comment('if the customer is registered');
            $table->boolean('is_vip')->nullable()->default(false)->comment('if the customer is vip');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('headimgurl')->nullable()->comment('wechat headimgurl');

            $table->unsignedInteger('beans_total')->default(0)->comment('迈豆总额');

            $table->index('openid');
            $table->unique('openid');
            $table->unique('qr_code');
            $table->unique('phone');

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
        Schema::drop('customers');
    }
}
