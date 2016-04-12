<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperators', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedInteger('cooperator_id')->nullable()->after('referrer_id');

            $table->foreign('cooperator_id')
                ->references('id')->on('cooperators');
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
            $table->dropForeign('customers_cooperator_id_foreign');

            $table->dropColumn('cooperator_id');
        });

        Schema::drop('cooperators');
    }
}
