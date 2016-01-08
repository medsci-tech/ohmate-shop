<?php

use Illuminate\Database\Seeder;

class CustomerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customer_types')->insert(
            ['type_en' => 'patient',  'type_ch' => '患者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'volunteer',  'type_ch' => '志愿者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'nurse',  'type_ch' => '护士' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'doctor',  'type_ch' => '医生' ]
        );

    }
}
