<?php

namespace App\Http\Controllers\ProductController;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ProductInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productInterface;
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface=$productInterface;
    }


    public function index()
    {
        return $this->productInterface->index();
    }


    public function store(ProductRequest $request)
    {
        return $this->productInterface->store($request);
    }

    public function update(ProductRequest $request)
    {
        return $this->productInterface->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->productInterface->destroy($request);
    }
}
