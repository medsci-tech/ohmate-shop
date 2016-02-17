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
            $table->integer('type_id')->unsigned()->comment('用户类型ID');
            $table->foreign('type_id')->references('id')->on('customer_types');
            $table->integer('referrer_id')->unsigned()->default(0)->comment();

            $table->string('phone', 31)->nullable()->comment('personal telephone');
            $table->unique('phone');
            $table->boolean('is_registered')->default(false)->comment('is the user registered');
            $table->string('auth_code', 11)->nullable()->comment('sms auth code');
            $table->timestamp('auth_code_expired')->nullable()->comment('sms auth code expired');
            $table->double('beans_total', 15, 2)->default(0)->comment('迈豆总额');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('head_image_url')->nullable()->comment('wechat head img url');
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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('customers_type_id_foreign');
        });
        Schema::drop('customers');
    }
}
