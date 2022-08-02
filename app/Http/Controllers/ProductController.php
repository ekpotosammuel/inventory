<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,gif|max:2048',
            'qty'=>'required',
            ]);
            $product = new Product();
            $product->name=$request->input('name');
            $product->price=$request->input('price');
            $product->image=$request->file('image')->store('buckets/images');
            $product->qty=$request->input('qty');
            $product->save();
            // $data = [
            //     'status' 		=> 'success',
            //     "message" => "student record created"
            // ];
            return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findorFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'image'=>'required',
            'qty'=>'required',
            ]);
            $product = Product::findorFail($id);
            $product->name=$request->input('name');
            $product->price=$request->input('price');
            $product->image=$request->input('image');
            $product->qty=$request->input('qty');
            $product->update();
            return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $product = Product::findorFail($id);
        if($product->delete()){
            
            return 'deleted successfully';
        }
    }
}
