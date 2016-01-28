<?php

use Illuminate\Database\Seeder;

class VideoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_types')->insert(
            ['type_en' => 'zry',  'type_ch' => '针融易']
        );
    }
}
