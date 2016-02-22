<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserIdToCustomerIdInAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_user_id_foreign');
            $table->renameColumn('user_id', 'customer_id');

            $table->foreign('customer_id')
                ->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_customer_id_foreign');
            $table->renameColumn('customer_id', 'user_id');

            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }
}
