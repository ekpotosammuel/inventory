<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cart::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $user = auth('sanctum')->user()->id;
        $this->validate($request,[
            'product_id'=>'required',
            'qty'=>'required',
            
        ]);

        $product = Product::find($request->product_id);
        $cart =  new Cart();
        $cart->user_id          =   $user;
        $cart->product_id       =   $request->input('product_id');
        $cart->qty              =   $request->input('qty');
        if ($product->qty === 0) {
            return response()->json([
                'Message' => 'We Have '.$product->qty.' '.$product->name. ' Out of Stock',
                ]);
        }elseif ($cart->qty > $product->qty)
            return response()->json([
                'Status' => 'Numbers of Iteam You Want To Cart '.$cart->qty.' We Have '. $product->qty. ' Avalaible',
            ]);
        $cart->save();

        $product = Product::find($request->product_id);
        $product->qty;
        $product->qty = $product->qty - $cart->qty;
        $product->update();
        
        return response()->json([
            'status' => 'Cart Sucessful',
        ],200);

        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart, $id)
    {
        return Cart::findorFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart, $id)
    {
        $cart = Cart::findorFail($id);
        if($cart->delete()){
            
            return 'deleted successfully';
        }
    }
}
