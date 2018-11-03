<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile() {
        return view('user.profile')->with(['user' => Auth::user()]);
    }

    public function update(Request $request) {
        if ($request->profile_password != null) {
            if ($request->profile_password === $request->profile_password2) {
                \App\User::where('id', Auth::id())->update(['password' => Hash::make($request->profile_password)]);
            }
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars', $avatarName);
        $user->avatar = $avatarName;
        $user->save();
        return back()
            ->with('success','You have successfully upload image.');
        //return view('user.profile');
    }

    public function update_avatar(Request $request) {
        echo($request->avatar->getClientOriginalExtension());
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars', $avatarName);
        $user->avatar = $avatarName;
        $user->save();
        // return back()
        //     ->with('success','You have successfully upload image.');
    }
}
