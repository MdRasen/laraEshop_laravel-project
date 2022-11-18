@extends('layouts.customer')
@section('title', 'laraEshop - Coupon')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Coupon</h4>
            <p class="card-description">
                All available coupons here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Coupon ID</th>
                            <th>Coupon Code</th>
                            <th>Discount Amount</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer_coupons as $item)
                        <tr class="text-center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->coupon->coupon_code}}</td>
                            <td>৳ {{$item->coupon->discount_amount}}</td>
                            <td>{{$item->coupon->expiry_date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection