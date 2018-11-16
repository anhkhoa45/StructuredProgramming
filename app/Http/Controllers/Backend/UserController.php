<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepo->all($request, false);
        echo($users);
        // $test = \App\User::all();
        // echo($test);
        return view('backend.user.index', compact('users'));
    }

    public function create() {

    }

    public function store() {

    }

    public function show() {

    }

    public function edit() {

    }

    public function destroy() {

    }
}
