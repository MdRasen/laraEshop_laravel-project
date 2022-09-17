@extends('layouts.customer')
@section('title', 'laraEshop - Cart')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Cart</h4>
            <p class="card-description">
                Cart products can be managed here.
            </p>
            <a href="#" class="btn btn-light btn-block">Add New Product</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Product Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price (Tk)</th>
                            <th>Quantity</th>
                            <th>Total Price (Tk)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td><img src="#" alt="image"></td>
                            <td>XYZ</td>
                            <td>ABC</td>
                            <td>220</td>
                            <td>
                                <button class="btn btn-sm btn-danger"> - </button>
                                <button class="btn btn-sm">2</button>
                                <button class="btn btn-sm btn-primary"> + </button>
                            </td>
                            <td>440</td>
                            <td><a href="#" class="btn btn-sm btn-danger">Remove</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
