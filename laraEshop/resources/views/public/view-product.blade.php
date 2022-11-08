@extends('layouts.public')
@section('title', 'laraEshop - View Product')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/public/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{$product->name}}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('index')}}">Home</a>
                        <a href="{{route('public.category-products', ['category_slug'=>$category->slug])}}">{{$category->name}}</a>
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="container">
            @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> {{session('msg')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{asset('storage/product_images')}}/{{$product->thumbnail}}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$product->name}}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">৳ {{$product->price}}</div>
                    <p>{{$product->meta_description? $product->meta_description:$product->description}}</p>

                    <form action="{{route('customer.add-cart-quantity')}}" method="POST">
                        @csrf
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <!-- <div class="pro-qty"> -->
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input class="pro-qty" type="number" value="1" name="quantity" style="border: none; width:80px;">
                                <!-- </div> -->
                            </div>
                        </div>
                        <input type="submit" class="primary-btn" style="border: none;" value="ADD TO CART">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    </form>

                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab" style="padding-top: 20px;">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <span><b>MdRasen</b> | 9 days ago</span>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus.</p>

                                <hr>

                                <span><b>SadiRah</b> | 12 days ago</span>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, animi provident ea et enim porro.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($related_product as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('storage/product_images')}}/{{$item->thumbnail}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="{{route('customer.add-cart', ['product_id'=>$item->id])}}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}">{{$item->name}}</a></h6>
                            <h5>৳ {{$item->price}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->

@endsection
