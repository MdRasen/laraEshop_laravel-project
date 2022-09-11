<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
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
                "thumbnail"=>"mimes:jpg,png,jpeg,webp",
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
        $categories = category::all();
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

            if($category->thumnail){
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

        // return redirect('admin/view-category')->with('msg', 'Category has been updated successfully!');
    }
}
