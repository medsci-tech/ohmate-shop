<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentColomnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('actual_payment', 'cash_payment');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('cash_payment_calculated')->after('cash_payment')->default(0.00);
            $table->decimal('beans_payment')->after('cash_payment_calculated')->default(0.00);
            $table->decimal('beans_payment_calculated')->after('beans_payment')->default(0.00);
            $table->decimal('post_fee')->after('beans_payment_calculated')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['post_fee', 'beans_payment_calculated', 'beans_payment', 'cash_payment_calculated']);
            $table->renameColumn('cash_payment', 'actual_payment');
        });
    }
}
