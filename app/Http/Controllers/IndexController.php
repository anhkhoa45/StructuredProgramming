<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();


        $query = Product::whereHas('categories', function ($query) use ($request) {
            if($request->has('categories')){
                $query->whereIn('categories.id', $request->query('categories'));
            }
        })->with('categories');

        if($request->has('name')){
            $query = $query->where('products.name', 'LIKE', '%'.$request->query('name').'%');
        }

        if($request->has('size')){
            $query = $query->whereIn('products.size', 'IN', $request->query('size'));
        }

        if($request->has('gender')){
            $query = $query->where('products.gender', '=', $request->query('gender'));
        }

        if($request->has('price_min')){
            $query = $query->where('products.price', '>=', $request->query('price_min'));
        }

        if($request->has('price_max')){
            $query = $query->where('products.price', '<=', $request->query('price_max'));
        }

        $products = $query->get();

        return view('index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
