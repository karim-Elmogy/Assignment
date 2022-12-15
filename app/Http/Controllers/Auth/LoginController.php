<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\AuthTrait;
use App\Models\Service;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;
//
//
//    protected $redirectTo = RouteServiceProvider::HOME;


    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm($type)
    {
        return view('auth.login',compact('type'));
    }

    public function login(LoginRequest $request)
    {
       if (Auth::guard($this->checkGuard($request))->attempt(['email'=>$request->email,'password'=>$request->password,'stauts'=>0]))
       {
          return $this->redirect($request);
       }
       else
       {
           alert()->error('Error', $request->type.' Not Found');
           return redirect()->back();
       }

    }

    public function logout(Request $request,$type)
    {

        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }


}
