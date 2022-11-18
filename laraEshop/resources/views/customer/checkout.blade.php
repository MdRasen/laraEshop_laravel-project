@extends('layouts.customer')
@section('title', 'laraEshop - Checkout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Checkout</h4>
            <p class="card-description">
                Order can be managed from here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Product Image</th>
                            <th>Product Details</th>
                            <th>Price (Tk)</th>
                            <th>Total Price (Tk)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartitems as $item)
                        <tr class="text-center">
                            <td><img class="table-img" src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="image">
                            </td>
                            <td>
                                <h6>{{$item->quantity}}x {{$item->product->name}}</h6>
                                <p>{{$item->product->category->name}}</p>
                            </td>
                            <td>{{$item->product->price}}</td>
                            <td>{{$item->product->price * $item->quantity}}</td>
                        </tr>
                        @endforeach
                        <tr class="text-right">
                            <th colspan="3">Total Price</th>
                            <th colspan="2" class="text-center">৳ {{$total_price}}</th>
                        </tr>
                        <tr class="text-right">
                            <th colspan="3">Delivery Charge</th>
                            <th colspan="2" class="text-center">৳ 60</th>
                        </tr>
                        <tr class="text-right text-danger">
                            <th colspan="3">Total Payment</th>
                            <th colspan="2" class="text-center">৳ {{$total_price + 60}}</th>
                        </tr>
                    </tbody>
                </table>
                <hr>

                @if (session('alertmsg'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alert!</strong> {{session('alertmsg')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="col-12">
                    <form action="{{route('customer.view-checkout')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Payment Method</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="payment_method">
                                            <option>Cash On Delivery</option>
                                            <option>Bkash/Nagad</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Coupon</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="coupon_code" type="text" placeholder="Enter coupon code" value="{{old('coupon_code')}}">
                                        <p class="text-right" style="color:red;">@error('coupon_code')*{{$message}}@enderror</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2 pb-3">
                            <label class="col-form-label">Delivery Address</label>
                            <br>
                            <textarea class="p-2 form-control" name="delivery_address" style="width: 100%; height:80px;" placeholder="Enter delivery address" value="{{old('delivery_address')}}">{{$customer->address}}</textarea>
                            <p class="text-right" style="color:red;">@error('delivery_address')*{{$message}}@enderror</p>
                        </div>
                        <div class="form-group row float-right">
                            <a href="{{route('customer.view-cart')}}" class="btn btn-light">GO BACK</a>
                            <button type="submit" class="btn btn-primary mr-4">PLACE ORDER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection