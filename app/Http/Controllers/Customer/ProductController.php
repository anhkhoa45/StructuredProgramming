<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Foundation\Console\Presets\None;
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
    public function productDetailAjax(Request $request, $id){
        $product = $this->productService->find($id);
        if(empty($product)){
            return response()->json(['status'=>'notfound',]);
        }
        return response()->json([
            'status'=>'found',
            'id' =>  $product->id,
            'name'=> $product->name,
            'description'=> $product->description,
            'image'=> $product->image,
            'price'=> $product->price,
            'size'=> $product->size,
            'quantity'=> $product->quantity
        ]);
    }
}
