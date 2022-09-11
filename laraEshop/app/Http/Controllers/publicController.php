<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\customer;

class publicController extends Controller
{
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

            if($req->user_type == "Admin"){
                return redirect()->route('admin.dashboard');
            }

            elseif($req->user_type == "Customer"){
                return "Customer";
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
        
}
