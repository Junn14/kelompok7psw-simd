<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }} |  @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/img/favicon.png') }}">
		
		<!-- all css here -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/icofont.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/easyzoom.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{ asset('frontend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">

        <!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
        @livewireStyles
    </head>
    <body>

        <!-- header start -->
            <header>
                <div class="header-top-furniture wrapper-padding-2 res-header-sm">
                    <div class="container-fluid">
                        <div class="header-bottom-wrapper">
                            <div class="logo-2 furniture-logo ptb-30">
                                <a href="/">
                                    <img height="60" style="transform:scale(2.0);object-fit: cover;" src="{{ asset('frontend/assets/img/logo/Meraki.svg') }}" alt="">
                                </a>
                            </div>
                            <div class="menu-style-2 furniture-menu menu-hover">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="/">home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop.index') }}">shop</a>
                                        </li>
                                        <li><a href="#">Categories</a>
                                            <ul class="single-dropdown">
                                                @foreach($categories_menu as $category_menu)
                                                    <li><a href="{{ route('shop.index', $category_menu->slug) }}">{{ $category_menu->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.about-us') }}">About</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-cart">
                                <a class="icon-cart-furniture" href="{{ route('cart.index') }}">
                                    <i class="ti-bag"></i>
                                    <span class="shop-count-furniture green">{{ \Cart::getTotalQuantity() }}</span>
                                </a>
                                @if (!\Cart::isEmpty())
                                    <ul class="cart-dropdown">
                                    @foreach (\Cart::getContent() as $item)
                                        @php
                                            $product = $item->associatedModel;
											$image = !empty($product->firstMedia) ? asset('storage/images/products/'. $product->firstMedia->file_name) : asset('frontend/assets/img/cart/3.jpg')
                                        @endphp
                                        <li class="single-product-cart">
                                            <div class="cart-img">
                                                <a href="{{ route('product.show', $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
                                            </div>
                                            <div class="cart-title">
                                                <h5><a href="{{ route('product.show', $product->slug) }}">{{ $item->name }}</a></h5>
                                                <span>{{ number_format($item->price) }} x {{ $item->quantity }}</span>
                                            </div>
                                            <div class="cart-delete">
                                                <form id="deleteCart" action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <a href="" onclick="event.preventDefault();document.getElementById('deleteCart').submit();" class="delete"><i class="ti-trash"></i></a>
                                            </div>
                                        </li>
                                     @endforeach
                                        <li class="cart-space">
                                            <div class="cart-sub">
                                                <h4>Subtotal</h4>
                                            </div>
                                            <div class="cart-price">
                                                <h4>{{ number_format(\Cart::getSubTotal()) }}</h4>
                                            </div>
                                        </li>
                                        <li class="cart-btn-wrapper">
                                            <a class="cart-btn btn-hover" href="{{ route('cart.index') }}">view cart</a>
                                            <a class="cart-btn btn-hover" href="{{ route('checkout.process') }}">checkout</a>
                                        </li>
                                    </ul>
                                 @endif   
                            </div>
                        </div>
                        <div class="row">
                            <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                                <div class="mobile-menu">
                                    <nav id="mobile-menu-active">
                                        <ul class="menu-overflow">
                                            <li>
                                                <a href="#">HOME</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('shop.index') }}">shop</a>
                                            </li>
                                            <li><a href="#">categories</a>
                                                <ul>
                                                @foreach($categories_menu as $category_menu)
                                                    <li><a href="{{ route('shop.index', $category_menu->slug) }}">{{ $category_menu->name }}</a></li>
                                                @endforeach
                                                </ul>
                                            </li>
                                            <li><a href="#"> Contact  </a></li>
                                        </ul>
                                    </nav>							
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom-furniture wrapper-padding-2 border-top-3" style="border-bottom: 1px solid #e0e0e0;">
                    <div class="container-fluid">
                        <div class="furniture-bottom-wrapper">
                            <div class="furniture-login">
                                <ul>
                                    @guest
                                        <li>Get Access: <a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @else
                                        <li>Hello: <a href="{{ route('profile.index') }}">{{ auth()->user()->username }}</a></li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </ul>
                            </div>
                            <div class="furniture-search">
                                <form>
                                    <input placeholder="Search . . ." type="text" name="q" autocomplete="off" id="search">
                                    <button disabled>
                                        <i class="ti-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="furniture-wishlist">
                                <ul>
                                    <li>
                                        <a href="{{ route('favorite.index') }}"><i class="ti-heart"></i> Favorites</a>
                                    </li>
                                    @auth
                                    <li>
                                        <a href="{{ route('orders.index') }}"><i class=""></i> Orders</a>
                                    </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <!-- header end -->

        @yield('content')

        <!-- footer -->
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
    </header>

    <footer class="footer">
        <div class="footer-left">
            <h3>Payment Method</h3>
            <div class="credit-cards">
                <img src="frontend/assets/img/icon-img/3.png" alt="">
                <img src="img/mastercard.png" alt="">
                <img src="img/paypal.png" alt="">
            </div>
            <p class="footer-copyright">2023</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Indonesia</span> Kepulauan riau, Batam</p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p>+62 777-777-77</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="#">meraki@gmail.com</a></p>
            </div>
        </div>

        <div class="footer-right">
            <p class="footer-about">
                     <a href="{{ route('frontend.about-us') }}">About</a>
                Thrift online shop
            </p>

            <div class="footer-media">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>

    </footer>
</body>
</html>
                                  
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


     
       
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        @livewireScripts
		<!-- all js here -->
        <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/popper.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/ajax-mail.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                let bloodhound = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: '{{url("search")}}?productName=%QUERY%', //'/user/find?q=%QUERY%',
                        wildcard: '%QUERY%'
                    },
                });

                $('#search').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                }, {
                    name: 'products',
                    source: bloodhound,
                    limit: 10,
                    display: function(data) {
                        return data.name  //Input value to be set when you select a suggestion.
                    },
                    templates: {
                        empty: [
                            '<div class="list-group-item">There are no matching search results</div>'
                        ],
                        header: [
                            '<div class="list-group search-results-dropdown">'
                        ],
                        suggestion: function(data) {
                            return '<div style="font-weight:normal; width:100%" class="list-group-item"><a href="{{url('product')}}/'+data.slug+'">' + data.name + '</a></div></div>'
                        }
                    }
                });
            });
        </script>
    </body>
</html>
