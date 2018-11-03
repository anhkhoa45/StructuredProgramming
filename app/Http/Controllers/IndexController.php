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

        if($request->has('categories')){
            $query = Product::whereHas('categories', function ($query) use ($request) {
                $query->whereIn('categories.id', $request->query('categories'));
            })->with('categories');
        } else {
            $query = Product::with('categories');
        }


        if($request->has('name')){
            $query = $query->where('products.name', 'LIKE', '%'.$request->query('name').'%');
        }

        if($request->has('size')){
            $query = $query->whereIn('products.size', $request->query('size'));
        }

        if($request->has('gender')){
            $query = $query->whereIn('products.gender', $request->query('gender'));
        }

        if($request->filled('price_min')){
            $query = $query->where('products.price', '>=', $request->query('price_min'));
        }

        if($request->filled('price_max')){
            $query = $query->where('products.price', '<=', $request->query('price_max'));
        }

        $products = $query->paginate(6);

        return view('index', [
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
