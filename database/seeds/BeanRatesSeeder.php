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
            'rate' => 2180,
            'icon_url' => '/image/bean/new_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'sign_in',
            'action_ch' => '每日签到',
            'rate' => 20,
            'icon_url' => '/image/bean/sign_in_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'consume',
            'action_ch' => '消费抵扣',
            'rate' => 1,
            'icon_url' => '/image/bean/consume_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'invite',
            'action_ch' => '邀请糖友',
            'rate' => 100,
            'icon_url' => '/image/bean/invite_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'consume_feedback',
            'action_ch' => '消费返利',
            'rate' => 0.02,
            'icon_url' => '/image/bean/feedback_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'study',
            'action_ch' => '学习奖励',
            'rate' => 20,
            'icon_url' => '/image/bean/study_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'share',
            'action_ch' => '转发文章',
            'rate' => 10,
            'icon_url' => '/image/bean/share_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'volunteer_feedback',
            'action_ch' => '患者消费',
            'rate' => 0.05,
            'icon_url' => '/image/bean/volunteer_feedback_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'doctor_invite',
            'action_ch' => '邀请患者',
            'rate' => 3000,
            'icon_url' => '/image/bean/invite_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'nurse_invite',
            'action_ch' => '邀请患者',
            'rate' => 500,
            'icon_url' => '/image/bean/invite_icon.png'
        ]);

        DB::table('bean_rates')->insert([
            'action_en' => 'volunteer_invite',
            'action_ch' => '邀请患者',
            'rate' => 500,
            'icon_url' => '/image/bean/invite_icon.png'
        ]);

    }

} /*class*/
