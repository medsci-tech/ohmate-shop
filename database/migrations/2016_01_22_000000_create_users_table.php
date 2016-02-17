<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('outer_id')->nullable()->comment('用户在外部系统的ID');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();

            $table->string('phone')->nullable();
            $table->string('openid')->nullable();
            $table->string('nickname')->nullable();
            $table->string('portrait_url')->nullable();
            $table->string('qr_code_url')->nullable()->comment('推广二维码图像地址');
            $table->decimal('latitude', 8, 5)->nullable();
            $table->decimal('longitude', 8, 5)->nullable();
            $table->decimal('precision', 8, 5)->nullable()->comment('精度');

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
