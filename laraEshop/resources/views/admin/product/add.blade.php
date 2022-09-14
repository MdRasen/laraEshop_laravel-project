@extends('layouts.admin')
@section('title', 'laraEshop - Add Products')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Product</h4>
            <p class="card-description">
                Enter a title for your product, along with additional details.
            </p>
            <form action="{{route('admin.add-product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Product Name">
                    <p style="color:red;">@error('name')*{{$message}}@enderror</p>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{old('slug')}}" placeholder="Slug">
                            <p style="color:red;">@error('slug')*{{$message}}@enderror</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                @endforeach
                                <option value="999" selected>Others</option> 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
                    <p style="color:red;">@error('description')*{{$message}}@enderror</p>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" value="{{old('price')}}" placeholder="Price">
                        <p style="color:red;">@error('price')*{{$message}}@enderror</p>
                    </div>
                    <div class="col-sm-6">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{old('stock')}}" placeholder="Stock">
                        <p style="color:red;">@error('stock')*{{$message}}@enderror</p>
                    </div>
                </div>
                <h6 class="pt-2">SEO Details:</h6>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label>Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="2">{{old('meta_description')}}</textarea>
                        <p style="color:red;">@error('meta_description')*{{$message}}@enderror</p>
                    </div>
                    <div class="col-sm-6">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" rows="2">{{old('meta_keywords')}}</textarea>
                        <p style="color:red;">@error('meta_keywords')*{{$message}}@enderror</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-7">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail">
                        <p style="color:red;">@error('thumbnail')*{{$message}}@enderror</p>
                    </div>
                    <div class="col-sm-5 p-3 mt-4">
                        <label>Visibility: </label>
                        <input class="mt-1" type="checkbox" name="visibility" checked>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                <a href="{{route('admin.dashboard')}}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection
