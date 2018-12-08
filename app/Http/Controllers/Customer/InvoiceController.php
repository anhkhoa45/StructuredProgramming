<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Invoice;
use App\Services\InvoiceServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    protected $productService;

    public function __construct(InvoiceServiceInterface $productService)
    {
        $this->productService = $productService;
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
        $invoice = $this->productService->find($id);
        if (is_null($invoice)) {
            abort(404);
        }
        return view('customer.shopping.invoice', compact('invoice'));
    }
}


