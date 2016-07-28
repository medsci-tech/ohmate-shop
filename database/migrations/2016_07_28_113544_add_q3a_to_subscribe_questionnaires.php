<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQ3aToSubscribeQuestionnaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_questionnaires', function(Blueprint $table) {
            $table->string('q3a')->after('q3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_questionnaires', function(Blueprint $table) {
            $table->dropColumn(['q3a']);
        });
    }
}
