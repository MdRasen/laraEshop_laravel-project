@extends('layouts.admin')
@section('title', 'laraEshop - Edit Profile')
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
        <div class="card">
            <div class="card-body">
              {{-- <h4 class="card-title">User Info Update</h4> --}}
              <form action="{{route('admin.edit-profile')}}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-control" name="user_id" value="{{$user->id}}" placeholder="user_id" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="username" disabled>
                            <p style="color:red;">@error('username')*{{$message}}@enderror</p>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="name">
                            <p style="color:red;">@error('name')*{{$message}}@enderror</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="email">
                            <p style="color:red;">@error('email')*{{$message}}@enderror</p>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="phone">
                            <p style="color:red;">@error('phone')*{{$message}}@enderror</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="Male" {{$user->gender == "Male" ? 'selected':''}}>Male</option> 
                                <option value="Female" {{$user->gender == "Female" ? 'selected':''}}>Female</option>
                                <option value="Others" {{$user->gender == "Others" ? 'selected':''}}>Others</option>
                            </select>
                            <p style="color:red;">@error('gender')*{{$message}}@enderror</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" class="form-control" name="dob" value="{{$user->dob}}" placeholder="dob">
                            <p style="color:red;">@error('dob')*{{$message}}@enderror</p>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="2" placeholder="Address">{{$user->address}}</textarea>
                        <p style="color:red;">@error('address')*{{$message}}@enderror</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{route('admin.view-profile')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>        
    </div>
</div>

@endsection