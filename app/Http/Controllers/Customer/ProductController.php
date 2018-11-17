<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail(Request $request, $id) {
        $product = \App\Product::where('id', $id)->first();
        return view('customer.product.detail')->with(['product' => $product]);
    }

    public function checkProductQuantity(Request $request){
        $prodIds = $request->get('product_ids');
        $products = \App\Product::select(['id', 'quantity'])->whereIn('id', $prodIds)->get()->toArray();

        return $products;
    }
}
