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
        DB::table('bean_rates')->insert([
            'action_en' => 'register',
            'action_ch' => '用户注册',
            'rate' => 2000,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'sign_in',
            'action_ch' => '每日签到',
            'rate' => 20,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'consume',
            'action_ch' => '消费抵扣',
            'rate' => -1,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'invite',
            'action_ch' => '邀请糖友',
            'rate' => 100,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'consume_feedback',
            'action_ch' => '消费返利',
            'rate' => 0.02,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'scan_article',
            'action_ch' => '学习奖励',
            'rate' => 10,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'feedback_doctor_education',
            'action_ch' => '患者学习',
            'rate' => 0.1,
            'icon_url' => ''
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'feedback_doctor_consume',
            'action_ch' => '患者消费',
            'rate' => 0.05,
            'icon_url' => ''
        ]);
    }

} /*class*/
