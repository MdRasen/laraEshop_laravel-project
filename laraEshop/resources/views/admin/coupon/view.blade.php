@extends('layouts.admin')
@section('title', 'laraEshop - View Coupons')
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

            <h4 class="card-title">Coupons</h4>
            <p class="card-description">
                Coupons for your store can be managed here.
            </p>
            <a href="{{route('admin.add-coupon')}}" class="btn btn-light btn-block">Add New Coupon</a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Coupon Code</th>
                            <th>Discount (Tk)</th>
                            <th style="width: 30%">Description</th>
                            <th>Expiry Date</th>
                            <th>Visibility</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $item)
                        <tr>
                            <td>{{$item->coupon_code}}</td>
                            <td>{{$item->discount_amount}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->expiry_date}}</td>
                            <td>{{$item->visibility}}</td>
                            <td>
                                <a href="{{route('admin.edit-coupon', ['coupon_id'=>$item->id])}}"
                                    class="nav-link btn btn-sm btn-inverse-primary">Edit</a>
                            </td>
                            <td>
                                <button type="button" value="{{$item->id}}"
                                    class="nav-link btn btn-sm btn-inverse-danger deleteCouponBtn" data-toggle="modal"
                                    data-target="#deleteCouponBtn">Delete</button>

                                <!-- Modal -->
                                <div class="modal fade text-center" id="deleteCouponBtn" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Coupon</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete?</h5>
                                                <form action="{{route('admin.delete-coupon')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="coupon_id" name="coupon_id"
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
    {{$coupons->links()}}
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.deleteCouponBtn').click(function (e) {
            e.preventDefault();
            var coupon_id = $(this).val();
            $('#coupon_id').val(coupon_id);
            $('#deleteModal').modal('show');
        });
    });

</script>
@endsection
