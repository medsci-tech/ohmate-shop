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
        // zry
        $projectId = DB::table('projects')->where('project_en', 'zry')->first()->id;

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'focus',  'action_ch' => '关注', 'rate' => 100]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'register',  'action_ch' => '注册', 'rate' => 2080]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'sign_in',  'action_ch' => '签到', 'rate' => 20]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'consume',  'action_ch' => '消费', 'rate' => -1]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'invite',  'action_ch' => '安利', 'rate' => 100]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'feedback',  'action_ch' => '返利', 'rate' => 0.02]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'scan_article',  'action_ch' => '浏览图文', 'rate' => 10]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'scan_video',  'action_ch' => '浏览视频', 'rate' => 25]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'feedback_doctor_education',  'action_ch' => '患者学习返利', 'rate' => 0.1]
        );

        DB::table('bean_rates')->insert(
            ['project_id' => $projectId, 'action_en' => 'feedback_doctor_consume',  'action_ch' => '患者消费返利', 'rate' => 0.05]
        );

    }
} /*class*/
