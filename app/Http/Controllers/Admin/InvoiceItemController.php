<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 22:30
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\InvoiceItem;
use App\Services\InvoiceItemServiceInterface;
use App\Http\Controllers\Controller;

class InvoiceItemController extends Controller
{
    protected $productService;
    //

    public function __construct(InvoiceItemServiceInterface $productService)
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = $this->productService->find($id);
        if (is_null($transaction)) {
            abort(404);
        }
        return view('admin/transaction/edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->productService->rulesUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $this->productService->update($request, $id);
            return redirect()->route('admin.setting.product.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->back();
    }
    public function multiple_update(Request $request){

        for($i=0;$i<count($request->quantities);$i++){
            $transaction=$this->productService->find($request->transaction_ids[$i]);
            $product=$transaction->product;
            $product->quantity= $product->quantity-($request->quantities[$i]-$transaction->quantity);
            $transaction->quantity=$request->quantities[$i];
            $transaction->save();
        }
        return redirect()->back();
        echo 'hello';
    }
}


