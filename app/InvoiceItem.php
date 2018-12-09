<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class InvoiceItem extends Model
{
    //
    protected $table = 'invoice_items';
    protected $fillable = [
        'invoice_id', 'product_id','quantity'
    ];

    function product(){
        return $this->hasOne('App\Product', 'id','product_id');
    }

    function invoice(){
        return $this->belongsTo('App\Invoice', 'invoice_id','id');
    }
}
