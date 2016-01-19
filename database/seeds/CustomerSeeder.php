<?php

use Illuminate\Database\Seeder;

use App\Models\CustomerType;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $typeId = CustomerType::where('type_en', 'enterprise')->first()->id;
        DB::table('customers')->insert(
            ['type_id' => $typeId,  'beans_total' => 0, 'phone' => 'ykbl' ]
        );
    }
}
