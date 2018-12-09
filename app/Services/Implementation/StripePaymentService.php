<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 04/12/2018
 * Time: 15:07
 */

namespace App\Services\Implementation;


use App\Services\PaymentServiceInterface;
use Illuminate\Http\Request;

class StripePaymentService implements PaymentServiceInterface
{
//    private $secretApiKey = env('')


    /**
     * @param $apiToken
     */
    private function createStripeCharge($apiToken){

    }

    function pay(Request $request){
        $token = $request->get('stripeToken');
        $this->createStripeCharge($token);

        // call the InvoiceService to create invoice

    }

    function refund($paymentInfo)
    {
        // TODO: Implement refund() method.
    }
}
