<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationFieldsToCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->decimal('latitude', 8)->nullable()->default(0)->comment('经度');
            $table->decimal('longitude', 8)->nullable()->default(0)->comment('维度');
            $table->decimal('precision', 8)->nullable()->default(0)->comment('精度');
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
            //
        });
    }
}
