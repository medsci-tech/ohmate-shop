<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOneYuanFlagToCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commodities', function(Blueprint $table) {
            $table->string('special_sale')->nullable()->after('name');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->string('special_sale')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commodities', function(Blueprint $table) {
            $table->dropColumn('special_sale');
        });
        Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn('special_sale');
        });
    }
}
