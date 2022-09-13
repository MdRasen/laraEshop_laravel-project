<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

        return redirect('admin/view-products')->with('msg', 'Product has been added successfully!');
    }

    public function viewProduct(){
        $products = DB::table('products')->simplePaginate(4);
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
}
