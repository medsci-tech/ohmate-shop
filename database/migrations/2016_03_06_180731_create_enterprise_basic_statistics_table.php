<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseBasicStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_basic_statistics', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date')->comment('����');

            $table->integer('focus_count')->unsigned()->default(0)->comment('��ע�û���');
            $table->integer('register_count')->unsigned()->default(0)->comment('ע���û���');
            $table->integer('doctor_count')->unsigned()->default(0)->comment('ҽʦ��');

            $table->decimal('bean_count', 15, 4)->unsigned()->default(0)->comment('���������');
            $table->decimal('income_count', 15, 4)->unsigned()->default(0)->comment('Ӫҵ��/���˷�');

            $table->integer('study_count')->unsigned()->default(0)->comment('�����Ķ���');
            $table->integer('order_count')->unsigned()->default(0)->comment('������');
            $table->integer('commodity_count')->unsigned()->default(0)->comment('������Ʒ��');
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
        Schema::drop('enterprise_basic_statistics');
    }
}
