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
use App\Services\InvoiceServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;
    private $invoiceService;

    public function __construct(InvoiceServiceInterface $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    function getPayment() {
        return view('customer.shopping.payment');
    }

    function pay(Request $request) {
        $method = $request->get('method');
        switch ($method){
            case 'cash':
                $this->paymentService = new CashPaymentService();
                break;
            case 'stripe':
                $this->paymentService = new StripePaymentService();
                break;
        }

        $validator = \Validator::make($request->all(), [
            'receiver' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:14',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $this->paymentService->pay($request);
        $invoice = $this->invoiceService->store($request);

        // return view invoice;
        return redirect()->route('invoice.show_n_clear_cart', ['id' => $invoice->id]);
    }
}
