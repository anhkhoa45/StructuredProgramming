<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 10:28
 */

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class InvoiceItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 180; $i++) {
            for ($j = 0; $j < rand(1, 2); $j++) {
                DB::table('invoice_items')->insert([
                    'invoice_id' => $i,
                    'product_id' => rand(1, 9),
                    'quantity' => rand(1, 4),
                    'amount' => 0
                ]);
            }

        }
    }
}
