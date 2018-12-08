<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 04/12/2018
 * Time: 15:43
 */

namespace App\Services\Implementation;


use App\Services\PaymentServiceInterface;
use Illuminate\Http\Request;

class CashPaymentService implements PaymentServiceInterface
{
    private $invoiceService;

    public function __construct()
    {
        $this->invoiceService = new InvoiceService();
    }


    function pay(Request $request)
    {
        // call the InvoiceService to create invoice
        return $this->invoiceService->store($request);
    }
}
