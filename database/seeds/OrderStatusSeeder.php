<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            'name' => 'paying',
            'label' => '待支付',
        ]);

        DB::table('order_statuses')->insert([
            'name' => 'posting',
            'label' => '待发货',
        ]);

        DB::table('order_statuses')->insert([
            'name' => 'receiving',
            'label' => '待收货',
        ]);

        DB::table('order_statuses')->insert([
            'name' => 'finished',
            'label' => '已完成',
        ]);
    }
}
