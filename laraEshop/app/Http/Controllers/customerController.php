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
        $user_id = session()->get('id');
        $cart = cart::where('id', '=', $user_id)->first();

        if($cart){
            $cartitems = cart_item::where('cart_id', '=', $cart->id)->get();

            $total_price = 0;
            foreach ($cartitems as $item) {
                $total_price = ($total_price + ($item->quantity * $item->product->price));
            }
            return view('customer.cart', compact('cartitems', 'total_price'));
        }

        else{
            return Redirect()->back()->with('msg', 'No product in your cart!');
        }
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

    public function cartIncrement($cartitem_id){
        $cartitem = cart_item::where('id', '=', $cartitem_id)->first();
        if($cartitem){
            $cartitem->quantity = $cartitem->quantity + 1;
            $cartitem->update();
            return Redirect()->back()->with('msg', 'Cart product has been updated!');
        }
    }

    public function cartDecrement($cartitem_id){
        $cartitem = cart_item::where('id', '=', $cartitem_id)->first();
        if($cartitem){
            if($cartitem->quantity > 1){
                $cartitem->quantity = $cartitem->quantity - 1;
                $cartitem->update();
                return Redirect()->back()->with('msg', 'Cart product has been updated!');
            }
            else{
                return Redirect()->back()->with('alertmsg', 'Product quantity can not be less than 1!');
            }
        }
    }

    public function cartItemRemove(Request $req){
        $cartitem = cart_item::where('id', '=', $req->cart_item_id)->delete();
        return Redirect()->back()->with('msg', 'Cart product has been removed!');
    }
}
