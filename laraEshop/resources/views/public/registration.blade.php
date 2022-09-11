@extends('layouts.public')
@section('title', 'laraBlog - Login')
@section('content')

<div class="container-scroller" style="background-color: #F3F3F3;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-4 px-4 px-sm-5">
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="{{route('public.registration')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" value="{{old('username')}}">
                  <p class="text-right" style="color:red;">@error('username')*{{$message}}@enderror</p>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                  <p class="text-right" style="color:red;">@error('email')*{{$message}}@enderror</p>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  <p class="text-right" style="color:red;">@error('password')*{{$message}}@enderror</p>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="check">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                  <p class="text-right" style="color:red;">@error('check')*{{$message}}@enderror</p>
                </div>
                <div class="mt-3">
                  {{-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">SIGN UP</a> --}}
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="{{route('public.login')}}" class="text-primary">Login</a>
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