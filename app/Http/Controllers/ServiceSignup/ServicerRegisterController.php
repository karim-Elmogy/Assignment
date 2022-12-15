<?php

namespace App\Http\Controllers\ServiceSignup;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequestRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServicerRegisterController extends Controller
{
    public function index()
    {
        return view('register.register-service');
    }

    public function store(ServiceRequestRequest $request)
    {
        Service::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('login.show','service');
    }

    public function edit()
    {
        $service=Service::where('id',Auth::guard('service')->user()->id)->first();
        return view('service.profile.index',compact('service'));
    }

    public function update(ServiceRequestRequest $request)
    {
        $service=Service::find($request->id);
        $service->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        alert()->success('Success', 'Update Success');
        return redirect()->back();
    }
}
