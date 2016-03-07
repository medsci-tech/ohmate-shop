<?php

use Illuminate\Database\Seeder;

class ArticleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_types')->insert(
            ['type_en' => 'knowledge',  'type_ch' => '糖友科普']
        );

        DB::table('article_types')->insert(
            ['type_en' => 'drug',  'type_ch' => '药物治疗']
        );

        DB::table('article_types')->insert(
            ['type_en' => 'food',  'type_ch' => '膳食营养']
        );

        DB::table('article_types')->insert(
            ['type_en' => 'sport',  'type_ch' => '合理运动']
        );

        DB::table('article_types')->insert(
            ['type_en' => 'monitor',  'type_ch' => '血糖监测']
        );

    }
}
