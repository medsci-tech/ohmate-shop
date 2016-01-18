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
            ['type_en' => 'test',  'type_ch' => 'test' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'patient',  'type_ch' => '患者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'md_volunteer',  'type_ch' => '迈德志愿者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'merck_volunteer',  'type_ch' => '默克志愿者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'novo_volunteer',  'type_ch' => '诺和志愿者' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'nurse',  'type_ch' => '护士' ]
        );

        DB::table('customer_types')->insert(
            ['type_en' => 'doctor',  'type_ch' => '医生' ]
        );

    }
}
