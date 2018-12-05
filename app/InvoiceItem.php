<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class InvoiceItem extends Model
{
    //
    protected $table = 'invoiceitems';
    protected $fillable = [
        'invoice_id', 'product_id','quantity'
    ];

    function product(){
        return $this->belongsTo('App\Product', 'product_id','id');
    }

    function invoice(){
        return $this->belongsTo('App\Invoice', 'invoice_id','id');
    }
}
