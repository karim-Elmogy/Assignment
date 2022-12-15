<?php

namespace App\Http\Repositories\Api;

use App\Http\Interfaces\Api\OrderInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderRepository implements OrderInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $orders=Order::where('user_id',Auth::id())->get();
        return $this->apiResponse(200,'Orders',null,$orders);
    }

    public function store($request)
    {

        $user=Auth::user();

        $product=Product::find($request->id);

        $order=new Order();
        $order->name=$user->name;
        $order->email=$user->email;
        $order->user_id=$user->id;


        $order->product_id=$product->id;
        $order->price=$product->price;
        $order->image=$product->image;

        $order->status='Initiated';


        $order->save();

        return $this->apiResponse(200,'Order Was Created');
    }

    public function cancel($id)
    {
        $order=Order::find($id);
        $order->status='The User Cancel Order';
        $order->save();
        return $this->apiResponse(200,'Order Was Cancel');;
    }
}
