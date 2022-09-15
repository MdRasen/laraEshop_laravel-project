@extends('layouts.admin')
@section('title', 'laraEshop - Edit Products')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Product</h4>
            <p class="card-description">
                Edit your product, along with additional details.
            </p>
            <form action="{{route('admin.edit-product', ['product_id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Product Name">
                    <p style="color:red;">@error('name')*{{$message}}@enderror</p>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{$product->slug}}" placeholder="Slug">
                            <p style="color:red;">@error('slug')*{{$message}}@enderror</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{$product->category_id == $item->id ? 'selected':''}}>{{$item->name}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3">{{$product->description}}</textarea>
                    <p style="color:red;">@error('description')*{{$message}}@enderror</p>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" value="{{$product->price}}" placeholder="Price">
                        <p style="color:red;">@error('price')*{{$message}}@enderror</p>
                    </div>
                    <div class="col-sm-6">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{$product->stock}}" placeholder="Stock">
                        <p style="color:red;">@error('stock')*{{$message}}@enderror</p>
                    </div>
                </div>
                <h6 class="pt-2">SEO Details:</h6>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label>Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="2">{{$product->meta_description}}</textarea>
                        <p style="color:red;">@error('meta_description')*{{$message}}@enderror</p>
                    </div>
                    <div class="col-sm-6">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" rows="2">{{$product->meta_keywords}}</textarea>
                        <p style="color:red;">@error('meta_keywords')*{{$message}}@enderror</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-8">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail">
                        <p style="color:red;">@error('thumbnail')*{{$message}}@enderror</p>
                    </div>

                    <?php
                    if($product->thumbnail){
                        ?>
                        <img class="text-center" src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="product image" height="90px">
                        <?php
                    }
                    ?>

                    <div class="col-sm-4 p-3 mt-4">
                        <label>Visibility: </label>
                        <input class="mt-1" type="checkbox" name="visibility" {{$product->visibility == "Active" ? 'checked': ''}}>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update Product</button>
                <a href="{{route('admin.dashboard')}}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection
