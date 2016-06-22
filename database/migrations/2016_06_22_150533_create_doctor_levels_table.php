<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_levels', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('level');
            $table->integer('beans_invite');
            $table->integer('beans_max_per_month');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedInteger('level_id')->after('type_id')->nullable();
            $table->foreign('level_id')->references('id')->on('doctor_levels');
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
            $table->dropForeign('customers_level_id_foreign');
            $table->dropColumn('level_id');
        });
        Schema::drop('doctor_levels');
    }
}
