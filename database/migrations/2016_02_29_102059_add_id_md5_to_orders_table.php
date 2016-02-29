<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdMd5ToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('wx_out_trade_no')->after('id')->comment('商家订单号');
            $table->string('wx_transaction_id')->nullable()->after('wx_out_trade_no')->comment('微信订单号');

            $table->index('wx_out_trade_no');
            $table->index('wx_transaction_id');
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
            $table->dropIndex('orders_wx_transaction_id_index');
            $table->dropIndex('orders_wx_out_trade_no_index');

            $table->dropColumn(['wx_transaction_id', 'wx_out_trade_no']);
        });
    }
}
