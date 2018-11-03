<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            DB::table('products')->insert([
                'name' => str_random(10),
                'description' => str_random(30),
                'image' => '1.png',
                'price' => 10000,
                'size' => 'M'
            ]);
        }
    }
}
