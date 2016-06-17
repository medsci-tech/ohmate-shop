<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCanNotUseBeanPriceToCommodities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->decimal('min_cash_price')->default(0)->after('price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('min_cash_price_without_post_fee')->default(0)->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->dropColumn('min_cash_price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('min_cash_price_without_post_fee');
        });
    }
}
