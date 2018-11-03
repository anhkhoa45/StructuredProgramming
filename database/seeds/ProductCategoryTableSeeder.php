<?php

use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            DB::table('product_category')->insert([
                'product_id' => rand(1, 10),
                'category_id' => rand(1, 5),
            ]);
        }
    }
}
