<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function index()
    {
        $products=Product::all();
        return view('service.product.index',compact('products'));
    }



    public function store($request)
    {
        $product=new Product();
        $product->name=$request->name;
        $product->desc=$request->desc;
        $product->price=$request->price;


        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);


        $product->image=$imagename;


        $product->save();

        return redirect()->route('products.index');
    }

    public function update($request)
    {
        $product=Product::find($request->id);
        $product->name=$request->name;
        $product->desc=$request->desc;
        $product->price=$request->price;


        $image=$request->image;
        if ($request->hasFile('image'))
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);


            $product->image=$imagename;
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function destroy($request)
    {
        $product=Product::find($request->id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
