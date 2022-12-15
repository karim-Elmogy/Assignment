<?php

namespace App\Http\Repositories\SystemUse;

use App\Http\Interfaces\SystemUse\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{

    public function index()
    {
        abort_if(!Auth::guard('admin')->check(),403);
        $users=User::all();
        return view('admin.System-Use.user' ,compact('users'));
    }



    public function delete($id)
    {
        abort_if(!Auth::guard('admin')->check(),403);
       $user=User::find($id);
       $user->delete();
       return redirect()->back();
    }
}
