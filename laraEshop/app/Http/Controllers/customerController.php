<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cart_item;
use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function dashboard(){
        //Getting value form session
        $user_id = session()->get('id');

        $user = customer::where('id', '=', $user_id)->first();
        return view('customer.dashboard', compact('user'));
    }

    public function viewCart(){
        return view('customer.cart');
    }

    public function addCart($product_id){
        $user_id = session()->get('id');

        $cart = cart::where('id', '=', $user_id)->first();
        if(!$cart){
            $cart = new cart();
            $cart->customer_id = $user_id;
            $cart->save();
        }

        $cartitem = cart_item::where('cart_id', '=', $cart->id)->where('product_id', '=', $product_id)->first();

        if($cartitem){
            $cartitem->quantity = $cartitem->quantity + 1;
            $cartitem->update();
            return Redirect()->back()->with('msg', 'Cart product has been updated!');
        }

        else{
            $cartitem = new cart_item();
            $cartitem->cart_id = $cart->id;
            $cartitem->product_id = $product_id;
            $cartitem->quantity = 1;
            $cartitem->save();
    
            return Redirect()->back()->with('msg', 'Product has been added to your cart!');
        }
    }
}
