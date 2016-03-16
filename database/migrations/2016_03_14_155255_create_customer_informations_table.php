<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('name');
            $table->string('province')->nullable()->comment('省份,直辖市');
            $table->string('city')->nullable()->comment('城市,市级行政区');
            $table->string('hospital')->nullable()->comment('医院');
            $table->string('department')->nullable()->comment('科室');
            $table->text('remark')->nullable()->comment('备注');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

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
        Schema::table('customer_informations', function (Blueprint $table) {
            $table->dropForeign('customer_informations_customer_id_foreign');
        });
        Schema::drop('customer_informations');
    }
}
