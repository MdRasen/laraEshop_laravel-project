@extends('layouts.customer')
@section('title', 'laraEshop - Cart')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            @if (session('alertmsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> {{session('alertmsg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h4 class="card-title">Customer Cart</h4>
            <p class="card-description">
                Cart products can be managed here.
            </p>
            <a href="{{route('index')}}" class="btn btn-light btn-block">Add New Product</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Product Image</th>
                            <th>Product Details</th>
                            <th>Price (Tk)</th>
                            <th>Quantity</th>
                            <th>Total Price (Tk)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartitems as $item)
                        <tr class="text-center">
                            <td><img class="table-img" src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="image">
                            </td>
                            <td>
                                <h6>{{$item->product->name}}</h6>
                                <p>{{$item->product->category->name}}</p>
                            </td>
                            <td>{{$item->product->price}}</td>
                            <td>
                                <a href="{{route('customer.cart-decrement', ['cartitem_id'=>$item->id])}}" class="btn btn-sm btn-danger"> - </a>
                                <button class="btn btn-sm">{{$item->quantity}}</button>
                                <a href="{{route('customer.cart-increment', ['cartitem_id'=>$item->id])}}" class="btn btn-sm btn-primary"> + </a>
                            </td>
                            <td>{{$item->product->price * $item->quantity}}</td>
                            <td>
                                {{-- <a href="#" class="btn btn-sm btn-danger">Remove</a> --}}
                                <button type="button" value="{{$item->id}}" class="nav-link btn btn-sm btn-danger deleteProductBtn" data-toggle="modal" data-target="#deleteProductBtn">Remove</button>

                                <!-- Modal -->
                                <div class="modal fade text-center" id="deleteProductBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Remove Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to remove?</h5>
                                                <form action="{{route('customer.cart-remove-item')}}" method="POST">
                                                    @csrf
                                                    <input type="text" id="product_id" name="cart_item_id" class="form-control">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Remove</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="text-center">
                            <th colspan="4">Total Price</th>
                            <th colspan="2">৳ {{$total_price}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pt-2 text-right">
                <a href="{{route('customer.dashboard')}}" class="btn btn-light">GO BACK</a>
                <a href="{{route('customer.view-checkout')}}" class="btn btn-primary mr-2">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.deleteProductBtn').click(function(e) {
            e.preventDefault();
            var product_id = $(this).val();
            $('#product_id').val(product_id);
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection