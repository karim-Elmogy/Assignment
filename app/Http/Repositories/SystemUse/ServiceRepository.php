<?php

namespace App\Http\Repositories\SystemUse;

use App\Http\Interfaces\SystemUse\ServiceInterface;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceRepository implements ServiceInterface
{

    public function index()
    {
        abort_if(!Auth::guard('admin')->check(),403);
        $services=Service::all();
        return view('admin.System-Use.service' ,compact('services'));
    }

    public function update($request)
    {
        abort_if(!Auth::guard('admin')->check(),403);
        $service=Service::find($request->id);
        $service->update([
            'stauts'=>$request->stauts,
        ]);
        return redirect()->back();
    }

    public function delete($id)
    {
        abort_if(!Auth::guard('admin')->check(),403);
        $service=Service::find($id);
        $service->delete();
        return redirect()->back();
    }


}
