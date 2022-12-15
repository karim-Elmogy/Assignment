<?php

namespace App\Http\Repositories\Api;


use App\Http\Interfaces\Api\AuthInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiRepositoies implements AuthInterface
{
    use ApiResponseTrait;

    public function register($request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:6'
        ]);

        if($validation->fails())
        {
            return $this->apiResponse(400,'Not Found',$validation->fails());
        }

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $this->apiResponse(200,'Account Was Created');
    }




    public function Update($request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email'.$this->id,
            'password'=>'required|min:6'
        ]);

        if($validation->fails())
        {
            return $this->apiResponse(400,'Not Found',$validation->fails());
        }
        $user=User::where('id',$request->id)->first();
        $user->Update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $this->apiResponse(200,'Account Was Update');
    }



    public function login($request)
    {
        Auth::shouldUse('api');

        $validation=Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required|min:6'
        ]);

        if($validation->fails())
        {
            return $this->apiResponse(400,'Not Found',$validation->fails());
        }


        $userData = $request->only('email','password');

        if($token=Auth::attempt($userData))
        {
            return $this->respondWithToken($token);
        }

        return $this->apiResponse(400,'Not Found');

    }






    protected function respondWithToken($token)
    {
        $array = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return $this->apiResponse(200,'login',null,$array);
    }


}
