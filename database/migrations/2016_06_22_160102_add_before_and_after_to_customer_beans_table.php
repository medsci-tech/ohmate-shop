<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeforeAndAfterToCustomerBeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_beans', function (Blueprint $table) {
            $table->decimal('before', 15, 2)->after('result')->nullable();
            $table->decimal('after', 15, 2)->after('before')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_beans', function (Blueprint $table) {
            $table->dropColumn(['before', 'after']);
        });
    }
}
