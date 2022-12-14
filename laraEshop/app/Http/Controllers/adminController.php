<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\category;
use App\Models\coupon;
use App\Models\customer;
use App\Models\customer_coupon;
use App\Models\product;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class adminController extends Controller
{
    public function dashboard()
    {
        //Getting value form session
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.dashboard', compact('user'));
    }

    public function addCategory()
    {
        return view('admin.category.add');
    }

    public function addCategorySubmit(Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => "required|string",
                "slug" => "nullable|string",
                "description" => "nullable|string|max:200",
                "thumbnail" => "required|mimes:jpg,png,jpeg,webp",
            ],
        );

        $category = new category();
        $category->name = $req->name;
        if ($req->slug) {
            $category->slug = Str::slug($req->slug);
        } else {
            $category->slug = Str::slug($req->name);
        }
        $category->description = $req->description;

        if ($req->thumbnail) {
            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time() . "." . $extension;
            $req->file('thumbnail')->storeAs('public/category_images', $imagename);
            $category->thumbnail = $imagename;
        }

        $category->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $category->save();

        return redirect('admin/view-category')->with('msg', 'Category has been added successfully!');
    }

    public function viewCategory()
    {
        $categories = DB::table('categories')->simplePaginate(4);
        return view("admin.category.view", compact('categories'));
    }

    public function editCategory($category_id)
    {
        $category = category::where('id', '=', $category_id)->first();
        return view("admin.category.edit", compact('category'));
    }

    public function editCategorySubmit($category_id, Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => "required|string",
                "slug" => "nullable|string",
                "description" => "nullable|string|max:200",
                "thumbnail" => "mimes:jpg,png,jpeg,webp",
            ],
        );

        $category = category::where('id', '=', $category_id)->first();
        $category->name = $req->name;
        if ($req->slug) {
            $category->slug = Str::slug($req->slug);
        } else {
            $category->slug = Str::slug($req->name);
        }

        $category->description = $req->description;

        if ($req->thumbnail) {
            if ($category->thumbnail) {
                $destination = 'storage/category_images/' . $category->thumbnail;
                if (file_exists(public_path($destination))) {
                    unlink($destination);
                }
            }

            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time() . "." . $extension;
            $req->file('thumbnail')->storeAs('public/category_images', $imagename);
            $category->thumbnail = $imagename;
        }

        $category->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $category->update();

        return redirect('admin/view-category')->with('msg', 'Category has been updated successfully!');
    }

    public function deleteCategory(Request $req)
    {
        $category = category::where('id', '=', $req->category_id)->first();
        if ($category->thumbnail) {
            $destination = 'storage/category_images/' . $category->thumbnail;
            if (file_exists(public_path($destination))) {
                unlink($destination);
            }
        }
        $category->delete();
        return redirect('admin/view-category')->with('msg', 'Category has been deleted successfully!');
    }

    public function addProduct()
    {
        $categories = category::where('visibility', '=', "Active")->get();
        return view('admin.product.add', compact('categories'));
    }

    public function addProductSubmit(Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => "required|string",
                "slug" => "nullable|string",
                "description" => "nullable|string",
                "price" => "required",
                "stock" => "required",
                "meta_description" => "nullable|string|max:200",
                "meta_keywords" => "nullable|string|max:50",
                "thumbnail" => "required|mimes:jpg,png,jpeg,webp",
            ],
        );

        $product = new product();
        $product->name = $req->name;
        if ($req->slug) {
            $product->slug = Str::slug($req->slug);
        } else {
            $product->slug = Str::slug($req->name);
        }
        $product->category_id = $req->category_id;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->stock = $req->stock;
        $product->meta_description = $req->meta_description;
        $product->meta_keywords = $req->meta_keywords;

        if ($req->thumbnail) {
            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time() . "." . $extension;
            $req->file('thumbnail')->storeAs('public/product_images', $imagename);
            $product->thumbnail = $imagename;
        }

        $product->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $product->save();

        return redirect('admin/view-product')->with('msg', 'Product has been added successfully!');
    }

    public function viewProduct()
    {
        $products = product::where('id', '>', "0")->simplePaginate(4);
        return view("admin.product.view", compact('products'));
    }

    public function editProduct($product_id)
    {
        $product = product::where('id', '=', $product_id)->first();
        $categories = category::where('visibility', '=', "Active")->get();
        return view("admin.product.edit", compact('product', 'categories'));
    }

    public function editProductSubmit($product_id, Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => "required|string",
                "slug" => "nullable|string",
                "description" => "nullable|string",
                "price" => "required",
                "stock" => "required",
                "meta_description" => "nullable|string|max:200",
                "meta_keywords" => "nullable|string|max:50",
                "thumbnail" => "mimes:jpg,png,jpeg,webp",
            ],
        );

        $product = product::where('id', '=', $product_id)->first();
        $product->name = $req->name;
        if ($req->slug) {
            $product->slug = Str::slug($req->slug);
        } else {
            $product->slug = Str::slug($req->name);
        }
        $product->category_id = $req->category_id;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->stock = $req->stock;
        $product->meta_description = $req->meta_description;
        $product->meta_keywords = $req->meta_keywords;

        if ($req->thumbnail) {
            if ($product->thumbnail) {
                $destination = 'storage/product_images/' . $product->thumbnail;
                if (file_exists(public_path($destination))) {
                    unlink($destination);
                }
            }

            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time() . "." . $extension;
            $req->file('thumbnail')->storeAs('public/product_images', $imagename);
            $product->thumbnail = $imagename;
        }

        $product->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $product->update();

        return redirect('admin/view-product')->with('msg', 'Product has been updated successfully!');
    }

    public function deleteProduct(Request $req)
    {
        $product = product::where('id', '=', $req->product_id)->first();
        if ($product->thumbnail) {
            $destination = 'storage/product_images/' . $product->thumbnail;
            if (file_exists(public_path($destination))) {
                unlink($destination);
            }
        }
        $product->delete();
        return redirect('admin/view-product')->with('msg', 'Product has been deleted successfully!');
    }

    public function viewProfile()
    {
        //Getting value form session
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.profile.view', compact('user'));
    }

    public function updateProfilePic(Request $req)
    {
        $this->validate(
            $req,
            [
                "profile_pic" => "required|mimes:jpg,png,jpeg,webp",
            ],
        );
        $user_id = session()->get('id');
        $user = admin::where('id', '=', $user_id)->first();

        if ($user->profile_pic) {
            $destination = 'storage/admin_images/' . $user->profile_pic;
            if (file_exists(public_path($destination))) {
                unlink($destination);
            }
        }

        $extension = $req->file('profile_pic')->getClientOriginalExtension();
        $imagename = time() . "." . $extension;
        $req->file('profile_pic')->storeAs('public/admin_images/', $imagename);
        $user->profile_pic = $imagename;
        $user->update();

        session()->put('profile_pic', $imagename);
        return redirect('admin/view-profile')->with('msg', 'Profile Photo has been updated successfully!');
    }

    public function editProfile()
    {
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.profile.edit', compact('user'));
    }

    public function editProfileSubmit(Request $req)
    {
        $user_id = session()->get('id');
        $this->validate(
            $req,
            [
                "name" => "required|regex:/^[A-Z a-z,.-]+$/i",
                "email" => "required|email|unique:admins,email,$user_id",
                "phone" => "required|numeric|digits:10",
                "gender" => "required",
                "dob" => "required|before:-10 years",
                "address" => "required"
            ],
            [
                'name.regex' => 'Name cannot contain special characters or numbers.',
                'dob.before' => 'User must be 18 years or older.',
            ]
        );

        $user = admin::where('id', '=', $user_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->update();

        return redirect('admin/view-profile')->with('msg', 'Profile has been updated successfully!');
    }

    public function addCoupon()
    {
        return view('admin.coupon.add');
    }

    public function addCouponSubmit(Request $req)
    {
        $this->validate(
            $req,
            [
                'coupon_code' => "required|string|max:20|unique:coupons",
                "discount_amount" => "required|numeric",
                "description" => "nullable|string|max:200",
                "expiry_date" => "required|after:3 days",
            ],
        );

        $coupon = new coupon();
        $coupon->coupon_code = strtoupper($req->coupon_code);
        $coupon->discount_amount = $req->discount_amount;
        $coupon->description = $req->description;
        $coupon->expiry_date = $req->expiry_date;

        $coupon->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $coupon->save();

        return redirect('admin/view-coupon')->with('msg', 'Coupon has been added successfully!');
    }

    public function viewCoupon()
    {
        $coupons = DB::table('coupons')->simplePaginate(4);
        return view("admin.coupon.view", compact('coupons'));
    }

    public function editCoupon($coupon_id)
    {
        $coupon = coupon::where('id', '=', $coupon_id)->first();
        return view("admin.coupon.edit", compact('coupon'));
    }

    public function editCouponSubmit($coupon_id, Request $req)
    {
        $this->validate(
            $req,
            [
                'coupon_code' => "required|string|max:20|unique:coupons,coupon_code,$coupon_id",
                "discount_amount" => "required|numeric",
                "description" => "nullable|string|max:200",
                "expiry_date" => "required|after:3 days",
            ],
        );

        $coupon = coupon::where('id', '=', $coupon_id)->first();
        $coupon->coupon_code = strtoupper($req->coupon_code);
        $coupon->discount_amount = $req->discount_amount;
        $coupon->description = $req->description;
        $coupon->expiry_date = $req->expiry_date;

        $coupon->visibility = $req->visibility == "" ? 'Disabled' : 'Active';
        $coupon->update();

        return redirect('admin/view-coupon')->with('msg', 'Coupon has been updated successfully!');
    }

    public function deleteCoupon(Request $req)
    {
        $coupon = coupon::where('id', '=', $req->coupon_id)->first();
        $coupon->delete();
        return redirect('admin/view-coupon')->with('msg', 'Coupon has been deleted successfully!');
    }

    public function assignCoupon(Request $req)
    {
        if ($req->coupon_assign == "All") {
            $customers = customer::all();

            foreach ($customers as $customer) {
                $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                    ->where('customer_id', '=', $customer->id)->first();

                if ($customer_coupon == null) {
                    $customer_coupon = new customer_coupon();
                    $customer_coupon->customer_id = $customer->id;
                    $customer_coupon->coupon_id = $req->coupon_id;
                    $customer_coupon->save();
                }
            }
            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to all customers!');
        } 
        elseif ($req->coupon_assign == "05 Orders") {
            $customers = customer::all();
            foreach ($customers as $customer) {
                $orders = order::where('customer_id', '=', $customer->id)->get();

                if (count($orders) >= 5) {
                    $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                        ->where('customer_id', '=', $customer->id)->first();

                    if ($customer_coupon == null) {
                        $customer_coupon = new customer_coupon();
                        $customer_coupon->customer_id = $customer->id;
                        $customer_coupon->coupon_id = $req->coupon_id;
                        $customer_coupon->save();
                    }
                }
            }
            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to specified customers!');
        } 
        elseif ($req->coupon_assign == "15 Orders") {
            $customers = customer::all();
            foreach ($customers as $customer) {
                $orders = order::where('customer_id', '=', $customer->id)->get();

                if (count($orders) >= 15) {
                    $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                        ->where('customer_id', '=', $customer->id)->first();

                    if ($customer_coupon == null) {
                        $customer_coupon = new customer_coupon();
                        $customer_coupon->customer_id = $customer->id;
                        $customer_coupon->coupon_id = $req->coupon_id;
                        $customer_coupon->save();
                    }
                }
            }
            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to specified customers!');
        } 
        elseif ($req->coupon_assign == "25 Orders") {
            $customers = customer::all();
            foreach ($customers as $customer) {
                $orders = order::where('customer_id', '=', $customer->id)->get();

                if (count($orders) >= 25) {
                    $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                        ->where('customer_id', '=', $customer->id)->first();

                    if ($customer_coupon == null) {
                        $customer_coupon = new customer_coupon();
                        $customer_coupon->customer_id = $customer->id;
                        $customer_coupon->coupon_id = $req->coupon_id;
                        $customer_coupon->save();
                    }
                }
            }
            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to specified customers!');
        } 
        elseif ($req->coupon_assign == "Recent Orders") {
            $date = Carbon::now()->subDay(10);
            $orders = order::where('created_at', '>=', $date)->get();

            foreach ($orders as $order) {
                $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                    ->where('customer_id', '=', $order->customer_id)->first();

                if ($customer_coupon == null) {
                    $customer_coupon = new customer_coupon();
                    $customer_coupon->customer_id = $order->customer_id;
                    $customer_coupon->coupon_id = $req->coupon_id;
                    $customer_coupon->save();
                }
            }

            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to specified customers!');
        }

        elseif ($req->coupon_assign == "Old Orders") {
            $date = Carbon::now()->subMonth(10);
            $orders = order::where('created_at', '<=', $date)->get();

            foreach ($orders as $order) {
                $customer_coupon = customer_coupon::where('coupon_id', '=', $req->coupon_id)
                    ->where('customer_id', '=', $order->customer_id)->first();

                if ($customer_coupon == null) {
                    $customer_coupon = new customer_coupon();
                    $customer_coupon->customer_id = $order->customer_id;
                    $customer_coupon->coupon_id = $req->coupon_id;
                    $customer_coupon->save();
                }
            }

            return redirect('admin/view-coupon')->with('msg', 'Coupon has been assigned to specified customers!');
        }
    }

    public function viewOrder(Request $req){
        if($req->date && $req->status == "All Orders"){
            $orders = order::where('created_at', 'like', $req->date.'%')->simplePaginate(4);
            return view("admin.order.view", compact('orders'));
        }

        elseif($req->date && $req->status != "All Orders"){
            $orders = order::where('created_at', 'like', $req->date.'%')->where('status', '=', $req->status)
            ->simplePaginate(4);
            return view("admin.order.view", compact('orders'));
        }

        else{
            $orders = order::orderBy('updated_at', 'DESC')->simplePaginate(4);
            return view("admin.order.view", compact('orders'));
        }

    }

    public function viewOrderDetails($order_number){
        $order = order::where('order_number', '=', $order_number)->first();
        $customer = customer::where('id', '=', $order->customer_id)->first();
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
            return view('admin.order.orderdetails', compact('order', 'order_items', 'total_price', 'coupon_discount', 'customer'));
        } else {
            return Redirect()->back()->with('msg', 'No order availabe!');
        }
    }

    public function updateOrder(Request $req){
        $order = order::where('id', '=', $req->order_id)->first();
        $order->status = $req->status;
        $order->payment_status = $req->payment_status;
        $order->update();

        return Redirect()->back()->with('msg', 'Order status has been updated!');    }
}
