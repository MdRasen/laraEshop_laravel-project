@extends('layouts.admin')
@section('title', 'laraEshop - View Products')
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

            <h4 class="card-title">Products</h4>
            <p class="card-description">
                Products for your store can be managed here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price (Tk)</th>
                            <th>Stock</th>
                            <th>Visibility</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>
                                <img class="table-img" src="{{asset('storage/product_images')}}/{{$item->thumbnail}}"
                                    alt="product image">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->stock}}</td>
                            <td>{{$item->visibility}}</td>
                            <td>
                                <a href="{{route('admin.edit-product', ['product_id'=>$item->id])}}"
                                    class="nav-link btn btn-sm btn-inverse-primary text-center">Edit</a>
                            </td>
                            <td>
                                <button type="button" value="{{$item->id}}"
                                    class="nav-link btn btn-sm btn-inverse-danger deleteProductBtn" data-toggle="modal"
                                    data-target="#deleteProductBtn">Delete</button>

                                <!-- Modal -->
                                <div class="modal fade text-center" id="deleteProductBtn" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete?</h5>
                                                <form action="{{route('admin.delete-product')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="product_id" name="product_id"
                                                        class="form-control">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    {{$products->links()}}
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.deleteProductBtn').click(function (e) {
            e.preventDefault();
            var product_id = $(this).val();
            $('#product_id').val(product_id);
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection