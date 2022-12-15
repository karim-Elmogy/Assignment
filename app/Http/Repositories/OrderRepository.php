<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderInterface
{

    public function index()
    {
        if(auth('service')->check() || auth('admin')->check())
        {
            $orders=Order::all();
        }
        else
        {
            $orders=Order::where('user_id',Auth::id())->get();
        }
        return view('Orders.index' ,compact('orders'));
    }

    public function store($request , $id)
    {

        $user=Auth::user();
        $product=Product::find($id);
        $order=new Order();
        $order->name=$user->name;
        $order->email=$user->email;
        $order->user_id=$user->id;


        $order->product_id=$product->id;
        $order->price=$product->price;
        $order->image=$product->image;

        $order->status='Initiated';


        $order->save();

        return redirect()->route('orders.index');
    }

    public function update($request)
    {
        $order=Order::find($request->id);
        $order->status=$request->status;
        $order->save();
        return redirect()->route('orders.index');
    }

    public function destroy($request)
    {
        $order=Order::find($request->id);
        $order->delete();
        return redirect()->route('orders.index');
    }

    public function cancel($id)
    {
        $order=Order::find($id);
        $order->status='The Order Canceled ';
        $order->save();
        return redirect()->route('orders.index');
    }
}
