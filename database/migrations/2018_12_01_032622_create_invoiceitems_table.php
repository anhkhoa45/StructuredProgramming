<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoiceitems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("invoice_id");
            $table->unsignedInteger("product_id");
            $table->integer("quantity");
            $table->timestamps();
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("invoice_id")->references("id")->on("invoices");
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}