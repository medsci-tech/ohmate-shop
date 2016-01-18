<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_en', 31)->comment('项目en');
            $table->string('project_ch', 31)->comment('项目ch');
            $table->double('total_beans', 15, 2)->default(0)->comment('项目总迈豆额度');
            $table->double('actual_beans', 15, 2)->default(0)->comment('项目当前实际迈豆数');
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
        Schema::drop('projects');
    }
}
