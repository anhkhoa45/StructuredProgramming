<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $table = 'invoices';
    protected $fillable = [
        'user_id', 'address','phone','status'
    ];

    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    function transactions(){
        return $this->hasMany('App\Transaction', 'invoice_id');
    }
}
