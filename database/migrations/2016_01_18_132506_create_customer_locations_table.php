<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('用户');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->decimal('latitude', 8, 5)->default(0)->comment('经度');
            $table->decimal('longitude', 8, 5)->default(0)->comment('维度');
            $table->decimal('precision', 8, 5)->default(0)->comment('精度');

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
        Schema::table('customer_locations', function (Blueprint $table) {
            $table->dropForeign('customer_locations_customer_id_foreign');
        });
        Schema::drop('customer_locations');
    }
}
