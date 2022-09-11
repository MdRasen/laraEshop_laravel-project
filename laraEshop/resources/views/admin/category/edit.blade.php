@extends('layouts.admin')
@section('title', 'laraEshop - Add Category')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Category</h4>
        <p class="card-description">
         A group of similar products that share related characteristics.
        </p>
        <form class="forms-sample" action="{{route('admin.edit-category', ['category_id'=>$category->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$category->name}}">
                    <p class="text-right" style="color:red;">@error('name')*{{$message}}@enderror</p>
                  </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" placeholder="Slug" value="{{$category->slug}}">
                </div>
                <p class="text-right" style="color:red;">@error('slug')*{{$message}}@enderror</p>
            </div>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="4">{{$category->description}}</textarea>
            <p class="text-right" style="color:red;">@error('description')*{{$message}}@enderror</p>
          </div>
          <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Thumbnail Upload</label>
                    <div class="input-group col-xs-12">
                      <input type="file" name="thumbnail" class="form-control file-upload-info" placeholder="Upload Image" value="{{old('thumbnail')}}">
                    </div>
                    <p class="text-right" style="color:red;">@error('thumbnail')*{{$message}}@enderror</p>
                  </div>
            </div>

            <?php
            if($category->thumbnail){
                ?>
                <img class="text-center" src="{{asset('storage/category_images')}}/{{$category->thumbnail}}" alt="Category image" height="90px">
                <?php
            }
            ?>

            <div class="col-4">
                <div class="form-group p-3 mt-4">
                    <label for="slug">Visibility:</label>
                    <input class="mt-1" type="checkbox" name="visibility" {{$category->visibility == "Active" ? 'checked': ''}}>
                </div>
                <p class="text-right" style="color:red;">@error('visibility')*{{$message}}@enderror</p>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Update Category</button>
          <a href="{{route('admin.dashboard')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>

@endsection