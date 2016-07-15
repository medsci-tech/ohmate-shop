<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMigrationToCustomerInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_informations', function (Blueprint $table) {
            $table->string('region')->after('name')->nullable();
            $table->string('region_level')->after('region')->nullable();
            $table->string('hospital_level')->after('hospital')->nullable();
            $table->string('referred_name')->after('name')->nullable();
            $table->string('referred_phone')->after('referred_name')->nullable();
            $table->string('phone')->after('name')->index()->nullable();
            $table->string('responsible')->after('region_level')->nullable();
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
            $table->dropColumn(['region', 'region_level', 'hospital_level', 'referred_name', 'referred_phone', 'phone', 'responsible']);
        });
    }
}
