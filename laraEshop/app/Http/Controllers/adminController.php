<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\category;
use App\Models\coupon;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class adminController extends Controller
{
    public function dashboard(){
        //Getting value form session
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.dashboard', compact('user'));
    }

    public function addCategory(){
        return view('admin.category.add');
    }

    public function addCategorySubmit(Request $req){
        $this->validate($req,
            [
                'name'=>"required|string",
                "slug"=>"nullable|string",
                "description"=>"nullable|string|max:200",
                "thumbnail"=>"required|mimes:jpg,png,jpeg,webp",
            ],
        );

        $category = new category();
        $category->name = $req->name;
        if($req->slug){
            $category->slug = Str::slug($req->slug);
        }
        else{
            $category->slug = Str::slug($req->name);
        }
        $category->description =$req->description;

        if($req->thumbnail){
            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time().".".$extension;
            $req->file('thumbnail')->storeAs('public/category_images', $imagename);
            $category->thumbnail = $imagename;
        }
        
        $category->visibility = $req->visibility == "" ? 'Disabled':'Active';
        $category->save();

        return redirect('admin/view-category')->with('msg', 'Category has been added successfully!');
    }

    public function viewCategory(){
        $categories = DB::table('categories')->simplePaginate(4);
        return view("admin.category.view", compact('categories'));
    }

    public function editCategory($category_id){
        $category = category::where('id', '=', $category_id)->first();
        return view("admin.category.edit", compact('category'));
    }

    public function editCategorySubmit($category_id, Request $req){
        $this->validate($req,
            [
                'name'=>"required|string",
                "slug"=>"nullable|string",
                "description"=>"nullable|string|max:200",
                "thumbnail"=>"mimes:jpg,png,jpeg,webp",
            ],
        );

        $category = category::where('id', '=', $category_id)->first();
        $category->name = $req->name;
        if($req->slug){
            $category->slug = Str::slug($req->slug);
        }
        else{
            $category->slug = Str::slug($req->name);
        }

        $category->description =$req->description;

        if($req->thumbnail){
            if($category->thumbnail){
                $destination = 'storage/category_images/'.$category->thumbnail;
                if(file_exists(public_path($destination))) {
                    unlink($destination); 
                }
            }

            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time().".".$extension;
            $req->file('thumbnail')->storeAs('public/category_images', $imagename);
            $category->thumbnail = $imagename;
        }
        
        $category->visibility = $req->visibility == "" ? 'Disabled':'Active';
        $category->update();

        return redirect('admin/view-category')->with('msg', 'Category has been updated successfully!');
    }

    public function deleteCategory(Request $req){
        $category = category::where('id', '=', $req->category_id)->first();
        if($category->thumbnail){
            $destination = 'storage/category_images/'.$category->thumbnail;
            if(file_exists(public_path($destination))) {
                unlink($destination); 
            }
        }
        $category->delete();
        return redirect('admin/view-category')->with('msg', 'Category has been deleted successfully!');
    }

    public function addProduct(){
        $categories = category::where('visibility', '=', "Active")->get();
        return view('admin.product.add', compact('categories'));
    }

    public function addProductSubmit(Request $req){
        $this->validate($req,
            [
                'name'=>"required|string",
                "slug"=>"nullable|string",
                "description"=>"nullable|string",
                "price" => "required",
                "stock" => "required",
                "meta_description"=>"nullable|string|max:200",
                "meta_keywords"=>"nullable|string|max:50",
                "thumbnail"=>"required|mimes:jpg,png,jpeg,webp",
            ],
        );
        
        $product = new product();
        $product->name = $req->name;
        if($req->slug){
            $product->slug = Str::slug($req->slug);
        }
        else{
            $product->slug = Str::slug($req->name);
        }
        $product->category_id =$req->category_id;
        $product->description =$req->description;
        $product->price =$req->price;
        $product->stock =$req->stock;
        $product->meta_description = $req->meta_description;
        $product->meta_keywords = $req->meta_keywords;

        if($req->thumbnail){
            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $imagename = time().".".$extension;
            $req->file('thumbnail')->storeAs('public/product_images', $imagename);
            $product->thumbnail = $imagename;
        }
        
        $product->visibility = $req->visibility == "" ? 'Disabled':'Active';
        $product->save();

        return redirect('admin/view-product')->with('msg', 'Product has been added successfully!');
    }

    public function viewProduct(){
        $products = product::where('id', '>', "0")->simplePaginate(4);
        return view("admin.product.view", compact('products'));
    }

    public function editProduct($product_id){
        $product = product::where('id', '=', $product_id)->first();
        $categories = category::where('visibility', '=', "Active")->get();
        return view("admin.product.edit", compact('product', 'categories'));
    }

    public function editProductSubmit($product_id, Request $req){
        $this->validate($req,
            [
                'name'=>"required|string",
                "slug"=>"nullable|string",
                "description"=>"nullable|string",
                "price" => "required",
                "stock" => "required",
                "meta_description"=>"nullable|string|max:200",
                "meta_keywords"=>"nullable|string|max:50",
                "thumbnail"=>"mimes:jpg,png,jpeg,webp",
            ],
        );

        $product = product::where('id', '=', $product_id)->first();
        $product->name = $req->name;
        if($req->slug){
            $product->slug = Str::slug($req->slug);
        }
        else{
            $product->slug = Str::slug($req->name);
        }
        $product->category_id =$req->category_id;
        $product->description =$req->description;
        $product->price =$req->price;
        $product->stock =$req->stock;
        $product->meta_description = $req->meta_description;
        $product->meta_keywords = $req->meta_keywords;

        if($req->thumbnail){
            if($product->thumbnail){
                $destination = 'storage/product_images/'.$product->thumbnail;
                if(file_exists(public_path($destination))) {
                    unlink($destination); 
                }
            }

        $extension = $req->file('thumbnail')->getClientOriginalExtension();
        $imagename = time().".".$extension;
        $req->file('thumbnail')->storeAs('public/product_images', $imagename);
        $product->thumbnail = $imagename;
        }

        $product->visibility = $req->visibility == "" ? 'Disabled':'Active';
        $product->update();

        return redirect('admin/view-product')->with('msg', 'Product has been updated successfully!');
    }

    public function deleteProduct(Request $req){
        $product = product::where('id', '=', $req->product_id)->first();
        if($product->thumbnail){
            $destination = 'storage/product_images/'.$product->thumbnail;
            if(file_exists(public_path($destination))) {
                unlink($destination); 
            }
        }
        $product->delete();
        return redirect('admin/view-product')->with('msg', 'Product has been deleted successfully!');
    }

    public function viewProfile(){
        //Getting value form session
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.profile.view', compact('user'));
    }

    public function updateProfilePic(Request $req){
        $this->validate($req,
            [
                "profile_pic"=>"required|mimes:jpg,png,jpeg,webp",
            ],
        );
        $user_id = session()->get('id');
        $user = admin::where('id', '=', $user_id)->first();

        if($user->profile_pic){
            $destination = 'storage/admin_images/'.$user->profile_pic;
                if(file_exists(public_path($destination))) {
                    unlink($destination); 
                }
        }

        $extension = $req->file('profile_pic')->getClientOriginalExtension();
        $imagename = time().".".$extension;
        $req->file('profile_pic')->storeAs('public/admin_images/', $imagename);
        $user->profile_pic = $imagename;
        $user->update();

        session()->put('profile_pic', $imagename);
        return redirect('admin/view-profile')->with('msg', 'Profile Photo has been updated successfully!');
    }

    public function editProfile(){
        $user_id = session()->get('id');

        $user = admin::where('id', '=', $user_id)->first();
        return view('admin.profile.edit', compact('user'));
    }

    public function editProfileSubmit(Request $req){
        $user_id = session()->get('id');
        $this->validate($req,
            [
                "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
                "email"=>"required|email|unique:admins,email,$user_id",
                "phone"=>"required|numeric|digits:10",
                "gender"=>"required",
                "dob"=>"required|before:-10 years",
                "address"=>"required"
            ],
            [
                'name.regex' => 'Name cannot contain special characters or numbers.',
                'dob.before' => 'User must be 18 years or older.',
            ]
        );

        $user=admin::where('id','=',$user_id)->first();
        $user->name = $req->name;
        $user->email =$req->email;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->update();
        
        return redirect('admin/view-profile')->with('msg', 'Profile has been updated successfully!');
    }

    public function addCoupon(){
        return view('admin.coupon.add');
    }

    public function addCouponSubmit(Request $req){
        $this->validate($req,
            [
                'coupon_code'=>"required|string|max:5|unique:coupons",
                "discount_amount"=>"required|numeric",
                "description"=>"nullable|string|max:200",
                "expiry_date"=>"required|after:7 days",
            ],
        );

        $coupon = new coupon();
        $coupon->coupon_code = strtoupper($req->coupon_code);
        $coupon->discount_amount = $req->discount_amount;
        $coupon->description = $req->description;
        $coupon->expiry_date = $req->expiry_date;

        $coupon->visibility = $req->visibility == "" ? 'Disabled':'Active';
        $coupon->save();

        return redirect('admin/view-coupon')->with('msg', 'Coupon has been added successfully!');
    }

    public function viewCoupon(){
        $coupons = DB::table('coupons')->simplePaginate(4);
        return view("admin.coupon.view", compact('coupons'));
    }
}
