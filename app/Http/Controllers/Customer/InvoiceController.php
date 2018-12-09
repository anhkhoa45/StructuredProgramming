<?php

namespace App\Http\Controllers\Customer;

use App\Services\Implementation\CashPaymentService;
use App\Services\Implementation\StripePaymentService;
use Illuminate\Http\Request;

use App\Invoice;
use App\Services\InvoiceServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceServiceInterface $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Auth::user()->invoices()->with('invoiceItems')->get();
        return view('customer.shopping.invoice_list', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = $this->invoiceService->find($id);
        if (is_null($invoice)) {
            abort(404);
        }
        return view('customer.shopping.invoice', compact('invoice'));
    }

    public function showAndClearCart($id)
    {
        $invoice = $this->invoiceService->find($id);
        if (is_null($invoice)) {
            abort(404);
        }
        return view('customer.shopping.invoice', ['invoice' => $invoice, 'clearCart' => true]);
    }

    public function cancel($id){
        $invoice = $this->invoiceService->find($id);
        $paymentService = NULL;
        switch ($invoice->payment_method){
            case 'cash':
                $paymentService = new CashPaymentService();
                break;
            case 'stripe':
                $paymentService = new StripePaymentService();
                break;
        }
        $paymentInfo = $invoice->getPaymentInfo();
        if (is_null($invoice)) {
            abort(404);
        }

        $this->invoiceService->cancelInvoice($invoice);
        $paymentService->refund($paymentInfo);

        return view('customer.shopping.invoice', ['invoice' => $invoice]);
    }

    public function update(Request $request, $id) {
        $this->invoiceService->update($request, $id);

        return redirect()->route('invoice.show', ['id' => $id]);
    }
}


