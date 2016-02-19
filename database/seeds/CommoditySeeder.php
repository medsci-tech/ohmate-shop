<?php

use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commodities')->insert([
            'name' => '诺和针®32G Tip ETW',
            'remark' => '一次性使用无菌注射针',
            'introduction' => '诺和针®32G Tip ETW位一次性使用无菌注射针，与诺和诺德胰岛素注射系统配合使用。',
            'price' => 22.00
        ]);

        DB::table('commodities')->insert([
            'name' => '低糖卫士',
            'remark' => '葡萄糖压片糖果',
            'introduction' => '葡萄糖压片糖果',
            'price' => 29.00
        ]);

        DB::table('commodities')->insert([
            'name' => '摇摇杯',
            'remark' => 'OGTT测试杯',
            'introduction' => 'OGTT测试杯',
            'price' => 20.00
        ]);

        DB::table('commodities')->insert([
            'name' => '易折清洁消毒棒',
            'remark' => '一次性使用无菌',
            'introduction' => '糖尿病患者血糖浓度高，血糖浓度含量更高，高糖环境是细菌良好的培养基。',
            'price' => 22.00
        ]);
        DB::table('commodities')->insert([
            'name' => '清呤卫士',
            'remark' => '碱性泡腾片',
            'introduction' => '碱性泡腾片',
            'price' => 22.00
        ]);

        DB::table('commodities')->insert([
            'name' => '诺和笔5',
            'price' => 249.00
        ]);

        DB::table('commodities')->insert([
            'name' => '补邮，满79包邮(偏远地区除外)',
            'price' => 0.01
        ]);
    }
}
