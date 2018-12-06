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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("invoice_id");
            $table->unsignedInteger("product_id");
            $table->integer("quantity");
            $table->bigInteger("amount");
            $table->timestamps();
            $table->foreign("product_id")->references("id")->on("products")->onDelete('cascade');;
            $table->foreign("invoice_id")->references("id")->on("invoices")->onDelete('cascade');;
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}