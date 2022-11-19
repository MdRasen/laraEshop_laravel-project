@extends('layouts.admin')
@section('title', 'laraEshop - View Orders')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h4 class="card-title">Orders</h4>
            <p class="card-description">
                Orders for your store can be managed here.
            </p>

            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label>Filter By Date</label>
                        <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Filter By Status</label>
                        <select name="status" class="form-control">
                            <option value="All Orders" {{Request::get('status')=="All Orders" ? 'selected':''}}>All Orders</option>
                            <option value="Pending" {{Request::get('status')=="Pending" ? 'selected':''}}>Pending</option>
                            <option value="In Progress" {{Request::get('status')=="In Progress" ? 'selected':''}}>In Progress</option>
                            <option value="Delivered" {{Request::get('status')=="Delivered" ? 'selected':''}}>Delivered</option>
                            <option value="Cancelled" {{Request::get('status')=="Cancelled" ? 'selected':''}}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Filter</button>
                        <a href="{{route('admin.view-order')}}"><button type="button" class="btn btn-light" style="margin-top: 30px;">Reset</button></a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>payment_method</th>
                            <th>payment_status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->order_number}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->payment_method}}</td>
                            <td>{{$item->payment_status}}</td>
                            <td>
                                 <a href="{{route('admin.view-order-details', ['order_number'=>$item->order_number])}}"
                                    class="nav-link btn btn-sm btn-primary">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div align="center">
    {{$orders->links()}}
</div>

@endsection
