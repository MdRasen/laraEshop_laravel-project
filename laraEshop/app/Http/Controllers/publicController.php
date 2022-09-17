<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\category;
use App\Models\product;

class publicController extends Controller
{
    public function index(){
        $categories = category::where('visibility', '=', "Active")->get();
        $products = product::where('visibility', '=', "Active")->get();
        $latest_products = product::where('visibility', '=', "Active")->orderBy('created_at' , 'DESC')->get()->take(4);
        $toprated_products = product::where('visibility', '=', "Active")->orderBy('created_at' , 'ASC')->get()->take(4);
        return view('index', compact('categories', 'products', 'latest_products', 'toprated_products'));
    }

    public function registration(){
        return view('public.registration');
    }

    public function registrationSubmit(Request $req){
        $this->validate($req,
            [
                'check'=>"required",
                "username"=>"required|unique:customers",
                "email"=>"required|email|unique:customers",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",

            ],
            [
                'password.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );

        $user = new customer();
        $user->username = $req->username;
        $user->email =$req->email;
        $user->password = $req->password;
        $user->save();

        return redirect('public/login')->with('msg', 'Registration has been completed!');
    }

    public function login(){
        return view('public.login');
    }

    public function loginSubmit(Request $req){
        $this->validate($req,
            [
                "user_type"=>'required',
                "username"=>"required",
                "password"=>"required",
            ],
        );

        if($req->user_type=="Admin"){$user=admin::where('username','=',$req->username)->where('password',$req->password)->first();}
        elseif($req->user_type=="Vendor"){$user=vendor::where('username','=',$req->username)->where('password',$req->password)->first();}
        elseif($req->user_type=="Customer"){$user=customer::where('username','=',$req->username)->where('password',$req->password)->first();}
        elseif($req->user_type=="Deliveryman"){$user=deliveryman::where('username','=',$req->username)->where('password',$req->password)->first();}

        if($user){
            session()->put('id',$user->id);
            session()->put('user_type',$req->user_type);
            session()->put('username', $user->username);
            session()->put('profile_pic', $user->profile_pic);

            if($req->user_type == "Admin"){
                return redirect()->route('admin.dashboard');
            }

            elseif($req->user_type == "Customer"){
                return redirect()->route('customer.dashboard');
            }

            elseif($req->user_type == "Vendor"){
                return "Vendor";
            }
            elseif($req->user_type == "Deliveryman"){
                return "Deliveryman";
            }
        }
        else {
            session()->flash('msg','Invalid username/password!');
            return back();
        }
    }

    public function logout(){
        session()->flush();
        session()->flash('msg','User has been successfully logged out!');
        return redirect()->route("public.login");
    }

    public function categoryProducts($category_slug){
        $categories = category::where('visibility', '=', "Active")->get();

        $category = category::where('slug', '=', $category_slug)->first();
        if($category){
            $products = product::where('category_id', '=', $category->id)->get();
            $latest_products = product::where('visibility', '=', "Active")->orderBy('created_at' , 'DESC')->get()->take(4);
            $toprated_products = product::where('visibility', '=', "Active")->orderBy('created_at' , 'ASC')->get()->take(4);
            return view('public.category-products', compact('products', 'category', 'categories', 'latest_products', 'toprated_products'));
        }
        else{
            return redirect('/');
        }
    }

    public function viewProduct($category_slug, $product_slug){
        $category = category::where('slug', '=', $category_slug)->first();
        if($category){
            $product = product::where('category_id', '=', $category->id)
            ->where('slug', '=', $product_slug)->where('visibility', '=', 'Active')
            ->first();

            if($product){
                $related_product = product::where('category_id', '=', $category->id)->where('slug', '!=', $product_slug)->where('visibility', '=', "Active")->get()->take(4);
                return view('public.view-product', compact('product', 'category', 'related_product'));
            }
        }
        else{
            return redirect('/');
        }
    }
        
}
