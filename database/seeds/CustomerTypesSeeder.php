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

        DB::table('customer_types')->insert(
            ['type_en' => 'common',  'type_ch' => '普通用户' ]
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

        DB::table('customer_types')->insert(
            ['type_en' => 'enterprise',  'type_ch' => '企业' ]
        );

    }

}
