@extends('layouts.public')
@section('title', 'laraEshop - Products')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/public/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Lara Eshop</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('index')}}">Home</a>
                        <span>Here</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            @foreach ($categories as $item)
                            <li><a href="{{route('public.category-products', ['category_slug'=>$item->slug])}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item" style="border-top: none; padding-top: 5px;">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{count($products)}}</span> Products on <span>{{$keyword}}</span></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php
                    if (count($products) <= 0) {
                    ?>
                        <img src="{{asset('assets/public/img/No_Product_Found.png')}}" alt="" class="center">
                    <?php
                    }
                    ?>

                    @foreach ($products as $item)

                    <div class="col-lg-4 col-md-6 col-sm-6">
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
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{asset('assets/public/img/banner/banner-1.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{asset('assets/public/img/banner/banner-2.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div>
                        <div>
                            @foreach ($latest_products as $item)
                            <a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>৳ {{$item->price}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div>
                        <div>
                            @foreach ($toprated_products as $item)
                            <a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>৳ {{$item->price}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div>
                        <div>
                            @foreach ($latest_products as $item)
                            <a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>৳ {{$item->price}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

@endsection