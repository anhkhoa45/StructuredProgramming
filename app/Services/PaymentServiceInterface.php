<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 04/12/2018
 * Time: 15:06
 */

namespace App\Services;


use Illuminate\Http\Request;

interface PaymentServiceInterface
{
    function pay(Request $request);
    function refund($paymentInfo);
}
