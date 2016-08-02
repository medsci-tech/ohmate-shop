<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYikangQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yikang_questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable()->unique();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('q1')->nullable();
            $table->string('q1b')->nullable();
            $table->string('q2')->nullable();
            $table->string('q2b')->nullable();
            $table->string('q3')->nullable();
            $table->string('q3a')->nullable();
            $table->string('q3b')->nullable();
            $table->string('q3c')->nullable();
            $table->string('q3d')->nullable();
            $table->string('q3d2')->nullable();
            $table->string('q3e')->nullable();
            $table->string('q4')->nullable();

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
        Schema::drop('yikang_questionnaires');
    }
}
