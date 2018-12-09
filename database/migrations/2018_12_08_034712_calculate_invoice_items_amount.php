<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalculateInvoiceItemsAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER `cal_invoice_items_amount`
            BEFORE INSERT ON `invoice_items`
            FOR EACH ROW 
            BEGIN
                SET NEW.amount = NEW.quantity * (SELECT price FROM products WHERE products.id = NEW.product_id);
                UPDATE invoices SET total = total + NEW.amount WHERE invoices.id = NEW.invoice_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `cal_invoice_items_amount`');
    }
}
