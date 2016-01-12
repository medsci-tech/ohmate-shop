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
            ['action_en' => 'essays_scan',  'action_ch' => '浏览图文', 'rate' => 10]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'video_scan',  'action_ch' => '浏览视频', 'rate' => 25]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'consume',  'action_ch' => '消费', 'rate' => 0.02]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'vip_essays_scan',  'action_ch' => 'vip浏览图文', 'rate' => 20]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'vip_video_scan',  'action_ch' => 'vip浏览视频', 'rate' => 50]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'vip_consume',  'action_ch' => 'vip消费', 'rate' => 0.05]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'education_feedback',  'action_ch' => '患者学习返利', 'rate' => 0.1]
        );

        DB::table('bean_rates')->insert(
            ['action_en' => 'consume_feedback',  'action_ch' => '患者消费返利', 'rate' => 0.05]
        );

    }
} /*class*/
