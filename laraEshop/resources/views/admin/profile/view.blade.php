@extends('layouts.admin')
@section('title', 'laraEshop - Profile')
@section('content')

@if (session('msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row pt-2">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                @if ($user->profile_pic == null)
                <img src="https://t4.ftcdn.net/jpg/00/65/77/27/360_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                    alt="admin avatar" class="img-fluid mt-5" style="height: 150px">
                @else
                <img src="{{asset('storage/admin_images')}}/{{$user->profile_pic}}" alt="admin avatar" class="img-fluid mt-5" style="height: 150px">
                @endif

                <h5 class="mt-5">{{$user->username}}</h5>
                <p class="text-muted my-2">Admin, laraEshop</p>
                <p class="text-muted my-2">{{$user->address != null ? $user->address:"Address not updated!"}}</p>

                <div class="pt-2">
                    <form action="{{route('admin.update-profilepic')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile_pic" class="form-control mt-3">
                        <p class="text-right" style="color:red;">@error('profile_pic')*{{$message}}@enderror</p>
                        <button type="submit" class="btn btn-outline-primary btn-block mt-3">Update Profile Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card mb-4 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">ID</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->id}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Username</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->username}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->name}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->email}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->phone}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Gender</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->gender}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">DOB</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->dob}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->address}}</p>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="justify-content-center">
                        <a href="{{route('admin.edit-profile')}}" class="btn btn-primary mr-1">Edit Profile</a>
                        <button type="button" class="btn btn-outline-primary">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
