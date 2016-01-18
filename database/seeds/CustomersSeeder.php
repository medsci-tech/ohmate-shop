<?php

use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeId= DB::table('customer_types')->where('type_en', 'test')->first()->id;
        DB::table('customers')->insert([
                'type_id' => $typeId,
                'phone' => '01234567890',
                'is_registered' => 'false',
                'beans_total' => 0]);
    }
}
