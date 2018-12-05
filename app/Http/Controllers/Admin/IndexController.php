<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use App\Services\ProductServiceInterface;

class IndexController extends Controller
{
    protected $userService;
    protected $productService;

    public function __construct(UserServiceInterface $userService, ProductServiceInterface $productService) {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $userNum = $this->userService->count();
        $productNum = $this->productService->count();
        return view('admin/index', compact('userNum', 'productNum'));
    }
    
}
