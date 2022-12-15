<?php

namespace App\Http\Controllers\OrderController;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface=$orderInterface;
    }

    public function index()
    {
        return $this->orderInterface->index();
    }

    public function store(Request $request ,$id)
    {
        return $this->orderInterface->store($request ,$id);
    }

    public function update(Request $request)
    {
        return $this->orderInterface->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->orderInterface->destroy($request);
    }
    public function cancel($id)
    {
        return $this->orderInterface->cancel($id);
    }

}
