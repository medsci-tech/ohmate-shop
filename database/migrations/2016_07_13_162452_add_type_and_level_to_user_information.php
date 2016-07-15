<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeAndLevelToUserInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_informations', function (Blueprint $table) {
            $table->string('type')->after('customer_id')->default('C');
            $table->integer('level')->after('type')->default(0);
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
            $table->dropColumn(['type', 'level']);
        });

    }
}
     