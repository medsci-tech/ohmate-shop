<?php

use Illuminate\Database\Seeder;

class BeanRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bean_rates')->insert(
            ['action_en' => 'focus',  'action_ch' => '关注', 'rate' => 100]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'register',  'action_ch' => '注册', 'rate' => 2000]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'invite',  'action_ch' => '安利', 'rate' => 100]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'login',  'action_ch' => '登录', 'rate' => 20]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'essays_scan',  'action_ch' => '浏览图文', 'rate' => 10]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'video_scan',  'action_ch' => '浏览视频', 'rate' => 25]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'consume',  'action_ch' => '消费', 'rate' => 0]
        );

    }
}
