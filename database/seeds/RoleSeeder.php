<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'user_administration',
            'label' => '管理用户',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'edit_article_index',
            'label' => '编辑文章列表',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'customer_administration',
            'label' => '管理微信用户',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'administrator',
            'label' => '超级管理员',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'editor',
            'label' => '编辑',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'customer_administrator',
            'label' => '用户管理员',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
