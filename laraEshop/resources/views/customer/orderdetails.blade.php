@extends('layouts.customer')
@section('title', 'laraEshop - Order Details')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Details</h4>
            <p class="card-description">
                View order details here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>

                        <tr>
                            <th colspan="2" style="font-size: 15px;">
                                Order Number <span style="color: blue;">#{{$order->order_number}}</span> <br>
                                <span style="font-size: 13px;">Placed on {{$order->created_at}}</span>
                            </th>
                            <th colspan="2" style="font-size: 15px;">
                                Status: <span style="color: red;">{{$order->status}}</span> <br>
                                Payment Status: <span style="color: red;">{{$order->payment_status}}</span>
                            </th>
                        </tr>

                        <tr class="text-center">
                            <th>Product Image</th>
                            <th>Product Details</th>
                            <th>Price (Tk)</th>
                            <th>Total Price (Tk)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
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
                            <th colspan="2" class="text-center">৳ {{$total_price}} </th>
                        </tr>
                        <tr class="text-right">
                            <th colspan="3">Delivery Charge</th>
                            <th colspan="2" class="text-center">৳ 60</th>
                        </tr>
                        <?php

                        if ($coupon_discount != 0) {
                        ?>
                            <tr class="text-right">
                                <th colspan="3">Coupon Discount</th>
                                <th colspan="2" class="text-center">- ৳
                                    {{$coupon_discount}}
                                </th>
                            </tr>
                        <?php
                        }

                        ?>
                        <tr class="text-right text-danger">
                            <th colspan="3">Total Payment</th>
                            <th colspan="2" class="text-center">৳ {{$order->total_payment}} </th>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="form-group float-right">
                    <a href="{{route('customer.view-order')}}" class="btn btn-primary">GO BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection