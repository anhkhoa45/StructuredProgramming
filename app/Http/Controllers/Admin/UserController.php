<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->index($request, false);
        return view('admin/user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleArr = User::roleArr();
        return view('admin/user/create', compact('roleArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->userService->rulesCreate());
        if ($validator->fails()) {
            $this->toastError($validator->errors()->toArray());
            return redirect()->back()->withErrors($validator);
        }
        $this->userService->store($request);
        return redirect()->route('admin.setting.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->find($id);
        if (is_null($user)) {
            abort(404);
        }
        $roleArr = User::roleArr();;
        return view('admin/user/show', compact('user', 'roleArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->find($id);
        if (is_null($user)) {
            abort(404);
        } else {
            $roleArr = User::roleArr();;
        }
        return view('admin/user/edit', compact('user', 'roleArr'));
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
        $validator = \Validator::make($request->all(), $this->userService->rulesUpdate($id));
        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator);
        }

        $this->userService->update($request, $id);
        return redirect()->route('admin.setting.user.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->delete($id);
        return redirect()->back();
    }
}
