<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            DB::table('categories')->insert([
                'name' => str_random(10),
                'description' => str_random(30)
            ]);
        }
    }
}
