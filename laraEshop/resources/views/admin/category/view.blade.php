@extends('layouts.admin')
@section('title', 'laraEshop - View Category')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            @if (session('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h4 class="card-title">Categories</h4>
            <p class="card-description">
                Product categories for your store can be managed here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Visibility</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>
                                    <img class="table-img" src="{{asset('storage/category_images')}}/{{$item->thumbnail}}" alt="Category image">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->visibility}}</td>
                                <td>
                                    <a href="{{route('admin.edit-category', ['category_id'=>$item->id])}}" class="nav-link btn-inverse-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="#" class="nav-link btn-inverse-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
