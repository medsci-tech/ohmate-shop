<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunmsToQuestionnaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_questionnaires', function(Blueprint $table) {
            $table->string('q3c')->after('q3b')->nullable();
            $table->string('q3d')->after('q3c')->nullable();
            $table->string('q3d2')->after('q3d')->nullable();
            $table->string('q3e')->after('q3d2')->nullable();
            $table->string('q4')->after('q3e')->nullable();
            $table->string('q1b')->after('q1')->nullable();
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
            $table->dropColumn(['q3c', 'q3d', 'q3d2', 'q3e', 'q4', 'q1b']);
        });
    }
}
