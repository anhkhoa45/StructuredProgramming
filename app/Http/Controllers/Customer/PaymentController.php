<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 04/12/2018
 * Time: 15:58
 */

namespace App\Http\Controllers\Customer;



use App\Http\Controllers\Controller;
use App\Http\Requests\PayRequest;
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

    /** Get payment page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getPayment() {
        return view('customer.shopping.payment');
    }

    /** Pay and create invoice
     * @param PayRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function pay(PayRequest $request) {
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
        $invoice = $this->invoiceService->store($request);

        return redirect()->route('invoice.show_n_clear_cart', ['id' => $invoice->id]);
    }
}
