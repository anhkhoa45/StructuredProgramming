<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 10:28
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_enum =["ordered","delivering"," delivered","canceled"];
        for($i = 0; $i < 180; $i++) {
            $date= now();
            $date->subDays(rand(0,365));
            $date->subHours(rand(0,24));

            DB::table('invoices')->insert([
                'user_id' => rand(3, 99),
                'address' => 'so: '.rand(3, 99).' phuong '.str_random(10).' thanh pho '.str_random(10),
                'phone' => ''.rand(100,999).'.'.rand(1000,9999).'.'.rand(100,999),
                'status' => 'ordered',
                'paid' => rand(0,1) == 1,
                'total' => 0,
                'payment_method' => 'cash',
                'receiver' => 'Mr.A',
                'created_at' => $date
            ]);
        }
    }
}
