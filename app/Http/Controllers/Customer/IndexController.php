<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        $products = $this->productService->index($request);

        return view('customer.index', [
            'categories' => $categories,
            'products' => $products,
            'searchData' => [
                'categories' => $request->query('categories'),
                'name' => $request->query('name'),
                'size' => $request->query('size'),
                'gender' => $request->query('gender'),
                'price_min' => $request->query('price_min'),
                'price_max' => $request->query('price_max'),
            ]
        ]);
    }
}
