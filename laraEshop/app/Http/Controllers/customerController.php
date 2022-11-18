<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cart_item;
use App\Models\coupon;
use App\Models\customer;
use App\Models\customer_coupon;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class customerController extends Controller
{
    public function dashboard()
    {
        //Getting value form session
        $user_id = session()->get('id');

        $user = customer::where('id', '=', $user_id)->first();
        return view('customer.dashboard', compact('user'));
    }

    public function viewCart()
    {
        $user_id = session()->get('id');
        $cart = cart::where('id', '=', $user_id)->first();

        if ($cart) {
            $cartitems = cart_item::where('cart_id', '=', $cart->id)->get();

            $total_price = 0;
            foreach ($cartitems as $item) {
                $total_price = ($total_price + ($item->quantity * $item->product->price));
            }
            return view('customer.cart', compact('cartitems', 'total_price'));
        } else {
            return Redirect()->back()->with('msg', 'No product in your cart!');
        }
    }

    public function addCart($product_id)
    {
        $user_id = session()->get('id');

        $cart = cart::where('id', '=', $user_id)->first();
        if (!$cart) {
            $cart = new cart();
            $cart->customer_id = $user_id;
            $cart->save();
        }

        $cartitem = cart_item::where('cart_id', '=', $cart->id)->where('product_id', '=', $product_id)->first();

        if ($cartitem) {
            $cartitem->quantity = $cartitem->quantity + 1;
            $cartitem->update();
            return Redirect()->back()->with('msg', 'Cart product has been updated!');
        } else {
            $cartitem = new cart_item();
            $cartitem->cart_id = $cart->id;
            $cartitem->product_id = $product_id;
            $cartitem->quantity = 1;
            $cartitem->save();

            return Redirect()->back()->with('msg', 'Product has been added to your cart!');
        }
    }

    public function addCartQuantity(Request $req)
    {
        $user_id = session()->get('id');

        $cart = cart::where('id', '=', $user_id)->first();
        if (!$cart) {
            $cart = new cart();
            $cart->customer_id = $user_id;
            $cart->save();
        }

        $cartitem = cart_item::where('cart_id', '=', $cart->id)->where('product_id', '=', $req->product_id)->first();

        if ($cartitem) {
            $cartitem->quantity = $cartitem->quantity + $req->quantity;
            $cartitem->update();
            return Redirect()->back()->with('msg', 'Cart product has been updated!');
        } else {
            $cartitem = new cart_item();
            $cartitem->cart_id = $cart->id;
            $cartitem->product_id = $req->product_id;
            $cartitem->quantity = $req->quantity;
            $cartitem->save();

            return Redirect()->back()->with('msg', 'Product has been added to your cart!');
        }
    }

    public function cartIncrement($cartitem_id)
    {
        $cartitem = cart_item::where('id', '=', $cartitem_id)->first();
        if ($cartitem) {
            $cartitem->quantity = $cartitem->quantity + 1;
            $cartitem->update();
            return Redirect()->back()->with('msg', 'Cart product has been updated!');
        }
    }

    public function cartDecrement($cartitem_id)
    {
        $cartitem = cart_item::where('id', '=', $cartitem_id)->first();
        if ($cartitem) {
            if ($cartitem->quantity > 1) {
                $cartitem->quantity = $cartitem->quantity - 1;
                $cartitem->update();
                return Redirect()->back()->with('msg', 'Cart product has been updated!');
            } else {
                return Redirect()->back()->with('alertmsg', 'Product quantity can not be less than 1!');
            }
        }
    }

    public function cartItemRemove(Request $req)
    {
        $cartitem = cart_item::where('id', '=', $req->cart_item_id)->delete();
        return Redirect()->back()->with('msg', 'Cart product has been removed!');
    }

    public function viewCheckout()
    {
        $user_id = session()->get('id');
        $customer = customer::where('id', '=', $user_id)->first();
        $cart = cart::where('id', '=', $user_id)->first();

        if ($cart) {
            $cartitems = cart_item::where('cart_id', '=', $cart->id)->get();

            if (count($cartitems) != 0) {
                $total_price = 0;
                foreach ($cartitems as $item) {
                    $total_price = ($total_price + ($item->quantity * $item->product->price));
                }
                return view('customer.checkout', compact('cartitems', 'total_price', 'customer'));
            } else {
                return Redirect()->back()->with('msg', 'No product in your cart!');
            }
        } else {
            return Redirect()->back()->with('msg', 'No product in your cart!');
        }
    }

    public function viewCheckoutSubmit(Request $req)
    {
        $user_id = session()->get('id');

        $this->validate(
            $req,
            [
                'delivery_address' => "required",
            ],
        );

        if (isset($req->coupon_code)) {
            $coupon_code = strtoupper($req->coupon_code);
            $coupon = coupon::where('coupon_code', '=', $coupon_code)->first();
            if ($coupon) {
                $customer_coupon = customer_coupon::where('coupon_id', '=', $coupon->id)
                    ->where('customer_id', '=', $user_id)->first();
                if ($customer_coupon) {
                    $customer = customer::where('id', '=', $user_id)->first();
                    $cart = cart::where('id', '=', $user_id)->first();
                    $cartitems = cart_item::where('cart_id', '=', $cart->id)->get();

                    $total_price = 60;
                    foreach ($cartitems as $item) {
                        $total_price = ($total_price + ($item->quantity * $item->product->price));
                    }
                    $total_price = $total_price - $coupon->discount_amount;

                    $order = new order();
                    $order->order_number = Str::random(10);
                    $order->customer_id = $customer->id;
                    $order->status = "Pending";
                    $order->payment_method = $req->payment_method;
                    $order->payment_status = "Unpaid";
                    $order->delivery_address = $req->delivery_address;
                    $order->coupon_id = $coupon->id;
                    $order->total_payment = $total_price;
                    $order->save();

                    foreach ($cartitems as $item) {
                        $order_item = new order_item();
                        $order_item->order_number = $order->order_number;
                        $order_item->product_id = $item->product_id;
                        $order_item->quantity = $item->quantity;
                        $order_item->save();
                    }
                    $cartitems = cart_item::where('cart_id', '=', $cart->id)->delete();

                    return redirect('customer/dashboard')->with('msg', 'Order has been placed!');
                } else {
                    return Redirect()->back()->with('alertmsg', 'Invalid coupon code!');
                }
            } else {
                return Redirect()->back()->with('alertmsg', 'Invalid coupon code!');
            }
        } else {
            $customer = customer::where('id', '=', $user_id)->first();
            $cart = cart::where('id', '=', $user_id)->first();
            $cartitems = cart_item::where('cart_id', '=', $cart->id)->get();

            $total_price = 60;
            foreach ($cartitems as $item) {
                $total_price = ($total_price + ($item->quantity * $item->product->price));
            }

            $order = new order();
            $order->order_number = Str::random(10);
            $order->customer_id = $customer->id;
            $order->status = "Pending";
            $order->payment_method = $req->payment_method;
            $order->payment_status = "Unpaid";
            $order->delivery_address = $req->delivery_address;
            $order->total_payment = $total_price;
            $order->save();

            foreach ($cartitems as $item) {
                $order_item = new order_item();
                $order_item->order_number = $order->order_number;
                $order_item->product_id = $item->product_id;
                $order_item->quantity = $item->quantity;
                $order_item->save();
            }
            $cartitems = cart_item::where('cart_id', '=', $cart->id)->delete();

            return redirect('customer/dashboard')->with('msg', 'Order has been placed!');
        }
    }

    public function viewCoupon()
    {
        $user_id = session()->get('id');
        $customer_coupons = customer_coupon::where('customer_id', '=', $user_id)->get();

        if ($customer_coupons) {
            return view('customer.coupon', compact('customer_coupons'));
        } else {
            return Redirect()->back()->with('msg', 'No coupon availabe!');
        }
    }

    public function viewOrder(){
        $user_id = session()->get('id');
        $orders = order::where('customer_id', '=', $user_id)->orderBy('updated_at', 'DESC')->simplePaginate(3);

        if ($orders) {
            return view('customer.order', compact('orders'));
        } else {
            return Redirect()->back()->with('msg', 'No order availabe!');
        }
    }

    public function viewOrderDetails($order_number){
        $user_id = session()->get('id');
        $order = order::where('order_number', '=', $order_number)->first();

        if ($order) {
            $order_items = order_item::where('order_number', '=', $order_number)->get();
            $total_price = 0;
                foreach ($order_items as $item) {
                    $total_price = ($total_price + ($item->quantity * $item->product->price));
                }
            $coupon = coupon::where('id', '=', $order->coupon_id)->first();
            if(!$coupon){
                $coupon_discount = 0;
            }
            else{
                $coupon_discount = $coupon->discount_amount;
            }
            return view('customer.orderdetails', compact('order', 'order_items', 'total_price', 'coupon_discount'));
        } else {
            return Redirect()->back()->with('msg', 'No order availabe!');
        }
    }
}
