@extends('layouts.public')
@section('title', 'laraEshop - Home')
@section('content')

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container text-center">
        @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> {{session('msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $item)
                <div class="col-lg-3">
                    <div class="categories__item set-bg"
                        data-setbg="{{asset('storage/category_images')}}/{{$item->thumbnail}}">
                        <h5><a href="{{route('public.category-products', ['category_slug'=>$item->slug])}}">{{$item->name}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $item)
                        <li data-filter=".{{$item->slug}}">{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($products as $item)
            <div class="col-lg-3 col-md-3 col-sm-4 mix {{$item->category->slug}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg"
                        data-setbg="{{asset('storage/product_images')}}/{{$item->thumbnail}}">
                        <ul class=" featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="{{route('customer.add-cart', ['product_id'=>$item->id])}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('public.view-product', ['category_slug'=>$item->category->slug, 'product_slug'=>$item->slug])}}">{{$item->name}}</a></h6>
                        <h5>৳ {{$item->price}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

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

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('assets/public/img/blog/blog-1.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('assets/public/img/blog/blog-1.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('assets/public/img/blog/blog-1.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection
