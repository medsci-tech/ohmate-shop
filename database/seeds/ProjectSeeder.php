<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('projects')->insert(
            ['project_en' => 'zry',  'project_ch' => '针融易', 'total_beans' => 100, 'actual_beans' => 100]
        );

        DB::table('projects')->insert(
            ['project_en' => 'hpxt',  'project_ch' => '黄埔学堂', 'total_beans' => 100, 'actual_beans' => 100]
        );

        DB::table('projects')->insert(
            ['project_en' => 'kzkt',  'project_ch' => '空中课堂', 'total_beans' => 100, 'actual_beans' => 100]
        );

    }
}
