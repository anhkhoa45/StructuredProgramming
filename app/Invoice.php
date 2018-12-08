<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = ['user_id', 'address', 'phone', 'status', 'receiver', 'paid', 'delivered', 'total'];

    protected function user(){
        return $this->belongsTo('App\User');
    }
    public function invoiceItems(){
        return $this->hasMany('App\InvoiceItem');
    }
}
