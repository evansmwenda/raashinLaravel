<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cart = Cart::where('user_id',\Auth::id())->get();
        dd(count($cart));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id){
        //creates a cart record if not exists
        $cart = Cart::where('user_id',\Auth::id())->first();
        // dd($cart);
        if(!is_null($cart)){
            //use has previously created a cart->add items to the cart
            // dd($cart);
            $cartItem = CartItem::where('cart_id',$cart->id)
            ->where('product_id',$product_id)->first();
            // dd($cartItem);
            if(!is_null($cartItem)){
                //user had already added product to cart->update quantity
                $cartItem->quantity = ++$cartItem->quantity;
                $cartItem->save();
                return redirect()->back()->with('success','Product added to cart successfully');
            }else{
                //add new product to cartItem
                $cartItem = new CartItem;
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $product_id;///$product_id;
                $cartItem->quantity = 1;
                $cartItem->save();

                return redirect()->back()->with('success','Product added to cart successfully');
            }
        }else{
            //create new record
            $cart = new Cart;
            $cart->user_id = \Auth::id();//$data['user_id'];
            $cart->save();
            $cart_id = $cart->id;

            //proceed now to insert product into cart item
            // 'cart_id','product_id','quantity',
            $cartItem = new CartItem;
            $cartItem->cart_id = $cart_id;
            $cartItem->product_id = $product_id;///$product_id;
            $cartItem->quantity = 1;
            $cartItem->save();

            return redirect()->back()->with('success','Product added to cart successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
