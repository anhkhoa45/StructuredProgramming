<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 04/12/2018
 * Time: 15:58
 */

namespace App\Http\Controllers\Customer;



use App\Http\Controllers\Controller;
use App\Services\Implementation\CashPaymentService;
use App\Services\Implementation\StripePaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    function getPayment() {
        return view('customer.payment.payment');
    }

    function pay(Request $request) {
        dd($request);

        $method = $request->get('method');
        switch ($method){
            case 'cash':
                $this->paymentService = new CashPaymentService();
                break;
            case 'stripe':
                $this->paymentService = new StripePaymentService();
                break;
        }

        $this->paymentService->pay($request);

        // return view invoice;
    }
}
