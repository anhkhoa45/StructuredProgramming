<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail(Request $request, $id) {
        $product = \App\Product::where('id', $id)->first();
        return view('product.detail')->with(['product' => $product]);
    }
}
