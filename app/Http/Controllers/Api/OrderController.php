<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderApiInterface;
    public function __construct(OrderInterface $orderApiInterface)
    {
        $this->orderApiInterface=$orderApiInterface;
    }
    public function index()
    {
        return $this->orderApiInterface->index();
    }

    public function store(Request $request)
    {
        return $this->orderApiInterface->store($request);
    }
    public function cancel($id)
    {
        return $this->orderApiInterface->cancel($id);
    }
}
