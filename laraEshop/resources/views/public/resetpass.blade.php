@extends('layouts.public')
@section('title', 'laraEshop - Reset Password')
@section('content')

<div class="container-scroller p-3" style="background-color: #F3F3F3;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-2 px-4 px-sm-5">
                        <h4>Hey! It's the time</h4>
                        <h6 class="font-weight-light">Reset your password here!</h6>
                        <form class="pt-3" action="{{route('public.reset-pass')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password">
                                <p class="text-right" style="color:red;">@error('password')*{{$message}}@enderror</p>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="cpassword" name="cpassword" placeholder="Confirm password">
                                <p class="text-right" style="color:red;">@error('cpassword')*{{$message}}@enderror</p>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Continue</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Already have an account? <a href="{{route('public.login')}}" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection