<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistrictToCustomerInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("customer_informations", function (Blueprint $table) {
            $table->string('district')->after('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("customer_informations", function (Blueprint $table) {
            $table->dropColumn('district');
        });
    }
}
