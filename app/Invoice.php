<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = ['user_id', 'address', 'phone', 'status', 'receiver', 'paid', 'total', 'payment_method'];

    protected function user(){
        return $this->belongsTo('App\User');
    }

    public function invoiceItems(){
        return $this->hasMany('App\InvoiceItem');
    }

    public function getStatusString(){
        switch ($this->status) {
            case 'ordered':
                return 'Đã đặt hàng';
                break;
            case 'delivering':
                return 'Đang giao hàng';
                break;
            case 'delivered':
                return 'Đã giao hàng';
                break;
            case 'canceled':
                return 'Đã hủy';
                break;
            default:
                break;
        }
    }

    public function completeOrdered(){
        return $this->status == 'ordered' || $this->status == 'delivering' || $this->status == 'delivered';
    }

    public function completeDelivering(){
        return $this->status == 'delivering' || $this->status == 'delivered';
    }

    public function completeDelivered(){
        return $this->status == 'delivered';
    }

    public function canBeCanceled(){
        return $this->status == 'ordered';
    }

    public function canBeEdited(){
        return $this->status == 'ordered';
    }

    public function getPaymentInfo(){
        return NULL;
}
}
