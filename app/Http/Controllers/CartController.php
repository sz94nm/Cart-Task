<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) { //check if user is logged in redirect to cart page with all the cart items of that user
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
            $data = [
                "cartItems" => $cartItems
            ];
            return view('/cart', $data);
        } else {
            return view('/');
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
        $rules = [

            "user_id" => "required",
            "product_id" => "required",
            "quantity" => "required",
            "product_stock" => "required",
        ];


        $data = $this->validate($request, $rules);
        //checks if the item is already in the users cart 
        $cart = Cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
        if ($cart!=null) {
            //check if the quantity is less than the stock 
            if($cart->quantity+$data["quantity"]<$data["product_stock"]){
                DB::table('carts')->where('user_id', $request->user_id)->where('product_id', $request->product_id)->increment('quantity', $data["quantity"]);
            }
            else{
                DB::table('carts')->where('user_id', $request->user_id)->where('product_id', $request->product_id)->update(array('quantity'=> $data["product_stock"]));

            }
            return Response::redirectTo("/");
        }


        Cart::create($data);

        return Response::redirectTo("/");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }
//empty cart
    public function empty()
    {

        if (Auth::check()) {
            $user = Auth::user();
            Cart::where('user_id', $user->id)->delete();
        }
        return redirect()->back();
    }
}
