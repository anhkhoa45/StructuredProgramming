<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function detail(Request $request, $id) {
        $product = $this->productService->find($id);
        return view('customer.product.detail')->with(['product' => $product]);
    }

    public function checkProductQuantity(Request $request){
        return $this->productService->checkQuantity($request);
    }
}
