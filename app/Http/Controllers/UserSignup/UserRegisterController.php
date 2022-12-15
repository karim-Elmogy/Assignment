<?php

namespace App\Http\Controllers\UserSignup;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRegisterController extends Controller
{
    public function index()
    {
        return view('register.register-user');
    }

    public function store(UserRegisterRequest $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('login.show','user');
    }

    public function edit()
    {
        $user=User::where('id',Auth::id())->first();
        return view('user.profile.index',compact('user'));
    }

    public function update(UserRegisterRequest $request)
    {
        $user=User::find($request->id);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        alert()->success('Success', 'Update Success');
        return redirect()->back();
    }


}
