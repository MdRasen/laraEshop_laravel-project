@extends('layouts.public')
@section('title', 'laraBlog - Login')
@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-4 px-4 px-sm-5">
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="{{route('public.login')}}" method="POST">
                @csrf
                <div>
                  <label for="user_type">Login As:</label>
                  <select name="user_type" class="user_type" >
                    <option value="Admin">Admin</option>
                    <option value="Vendor">Vendor</option>
                    <option value="Customer" selected>Customer</option>
                    <option value="Deliveryman">Deliveryman</option>
                  </select>
                  <p class="text-right" style="color:red;">@error('user_type')*{{$message}}@enderror</p>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                  <p class="text-right" style="color:red;">@error('username')*{{$message}}@enderror</p>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  <p class="text-right" style="color:red;">@error('password')*{{$message}}@enderror</p>
                </div>
                <p class="text-right" style="color: red;">{{Session::get('msg')}}</p>
                <div class="mt-3">
                  {{-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">SIGN IN</a> --}}
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-primary">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-success btn-block">
                    <i class="mdi mdi-email mr-2"></i>Connect using email
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="{{route('public.registration')}}" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

@endsection