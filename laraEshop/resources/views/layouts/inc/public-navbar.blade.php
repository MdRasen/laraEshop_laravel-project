<!-- Page Preloder -->
{{-- <div id="preloder">
    <div class="loader"></div>
</div> --}}

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        {{-- <a href="#"><img src="img/logo.png" alt=""></a> --}}
        {{-- using text title --}}
        <a class="navbar-brand text-dark" href="{{route('index')}}">
            <b>lara<span style="color: green;">Eshop.</span></b>
        </a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$0.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href={{route('public.login')}}"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{route('index')}}">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="#">Shop Details</a></li>
                    <li><a href="#">Shoping Cart</a></li>
                    <li><a href="#">Check Out</a></li>
                    <li><a href="#">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@laraeshop.com</li>
            <li>Free Shipping for all Order of Taka 500</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@laraeshop.com</li>
                            <li>Free Shipping for all Order Taka 500</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>

                        <div class="header__top__right__auth">
                            @if (session()->has('username'))
                                <a href="#"><i class="fa fa-user"></i>Welcome, <b>{{session()->get('username')}} </b></a>
                            @else
                                <a href="{{route('public.login')}}"><i class="fa fa-user"></i> Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    {{-- <a href="#"><img src="img/logo.png" alt=""></a> --}}
                    <a class="navbar-brand text-dark" href="{{route('index')}}">
                        <b>lara<span style="color: green;">Eshop.</span></b>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="./shop-grid.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="#">Shop Details</a></li>
                                <li><a href="#">Shoping Cart</a></li>
                                <li><a href="#">Check Out</a></li>
                                <li><a href="#">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>$0.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        @php
                        $categories = App\models\category::where('visibility', '=', "Active")->get();
                        @endphp
      
                        @foreach ($categories as $item)
                        <li><a href="{{route('public.category-products', ['category_slug'=>$item->slug])}}">{{$item->name}}</a></li>			  
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-right"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+880 163 0966 696</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->