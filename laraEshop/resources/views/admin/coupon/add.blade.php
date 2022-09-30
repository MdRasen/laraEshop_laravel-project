@extends('layouts.admin')
@section('title', 'laraEshop - Add Coupon')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add Coupon</h4>
        <p class="card-description">
            A ticket or document that can be redeemed for a financial discount or rebate when purchasing a product.
        </p>
        <form class="forms-sample" action="{{route('admin.add-coupon')}}" method="POST">
            @csrf
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" class="form-control" name="coupon_code" placeholder="Coupon code" value="{{old('coupon_code')}}">
                    <p class="text-right" style="color:red;">@error('coupon_code')*{{$message}}@enderror</p>
                  </div>  
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="discount_amount">Discount Amount</label>
                    <input type="number" class="form-control" name="discount_amount" placeholder="Discount amount" value="{{old('discount_amount')}}">
                </div>
                <p class="text-right" style="color:red;">@error('discount_amount')*{{$message}}@enderror</p>
            </div>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="4">{{old('description')}}</textarea>
            <p class="text-right" style="color:red;">@error('description')*{{$message}}@enderror</p>
          </div>
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Expiry Date</label>
                    <div class="input-group col-xs-12">
                      <input type="date" name="expiry_date" class="form-control" value="{{old('expiry_date')}}">
                    </div>
                    <p class="text-right" style="color:red;">@error('expiry_date')*{{$message}}@enderror</p>
                  </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group p-3 mt-4">
                    <label for="slug">Visibility:</label>
                    <input class="mt-1" type="checkbox" name="visibility" checked>
                </div>
                <p class="text-right" style="color:red;">@error('visibility')*{{$message}}@enderror</p>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Add Coupon</button>
          <a href="{{route('admin.dashboard')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>

@endsection