@extends('layouts.customer')
@section('title', 'laraEshop - Order')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Order</h4>
            <p class="card-description">
                View all available orders here.
            </p>
            <div class="table-responsive">
            @foreach ($orders as $item)
                <table class="table table-hover table-bordered bg-light">
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size: 15px;">
                                Order Number <span style="color: blue;">#{{$item->order_number}}</span> <br>
                                <span style="font-size: 13px;">Placed on {{$item->created_at}}</span>
                            </th>
                            <th style="font-size: 15px;">
                                Status: <span style="color: red;">{{$item->status}}</span> <br>
                                Payment Status: <span style="color: red;">{{$item->payment_status}}</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <th>Delivery Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$item->payment_method}}</td>
                            <td>{{$item->delivery_address}}</td>
                            <td>
                                <a href="{{route('customer.view-order-details', ['order_number'=>$item->order_number])}}"
                                    class="nav-link btn btn-sm btn-primary">View Details</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            @endforeach
            </div>
        </div>
    </div>
</div>

<div align="center">
    {{$orders->links()}}
</div>

@endsection