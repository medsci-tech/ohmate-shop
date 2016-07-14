<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribeQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable()->unique();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('q2b')->nullable();
            $table->string('q3')->nullable();
            $table->string('q3b')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_questionnaires', function (Blueprint $table) {
            $table->dropForeign('subscribe_questionnaires_customer_id_foreign');
        });
        Schema::drop('subscribe_questionnaires');
    }
}
