<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(CustomerTypesSeeder::class);
        $this->call(BeanRatesSeeder::class);

        $this->call(ArticleTypeSeeder::class);
        $this->call(VideoTypeSeeder::class);
    }
}
