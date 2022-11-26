@extends('layouts.public')
@section('title', 'laraEshop - Enter OTP')
@section('content')

<div class="container-scroller p-3" style="background-color: #F3F3F3;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">

            @if (session('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="auth-form-light text-left py-2 px-4 px-sm-5">
              <h4>Hey! Enter the OTP</h4>
              <h6 class="font-weight-light">Verification code has been sent to your email.</h6>
              <form class="pt-3" action="{{route('public.enter-otp')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="otp" name="otp" placeholder="Enter OTP" value="{{old('otp')}}">
                  <p class="text-right" style="color:red;">@error('otp')*{{$message}}@enderror</p>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
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