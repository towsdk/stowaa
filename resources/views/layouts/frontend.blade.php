
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from products.wp-ts.com/stowaa/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Sep 2022 06:53:25 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo/favourite_icon_1.png')}}">

    <!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css')}}">

    <!-- icon font - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/fontawesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stroke-gap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/icofont.css')}}">

    <!-- animation - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css')}}">

    <!-- carousel - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick-theme.css')}}">

    <!-- popup - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/magnific-popup.css')}}">

    <!-- jquery-ui - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery-ui.css')}}">

    <!-- select option - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nice-select.css')}}">

    <!-- woocommercen - css include -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/woocommerce.css')}}"> --}}
    
    @yield('css')
    
    <!-- custom - css include -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css"  />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css')}}">
    
    
</head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">
        
        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        {{-- <div id="preloader"></div> --}}
        <!-- preloader - end -->

        
        <!-- header_section - start
        ================================================== -->
        <header class="header_section header-style-no-collapse">
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <ul class="header_select_options ul_li">
                                <li>
                                    <div class="select_option">
                                        <div class="flug_wrap">
                                            <img src="{{ asset('frontend/images/flug/flug_uk.png')}}" alt="image_not_found">
                                        </div>
                                        <select class="nice_select">
                                            <option data-display="Select Option">Select Your Language</option>
                                            <option value="1" selected>English</option>
                                            <option value="2">Bangla</option>
                                            <option value="3" disabled>Arabic</option>
                                            <option value="4">Hebrew</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="select_option">
                                        <h3 class="title_text">Currency:</h3>
                                        <select>
                                            <option data-display="Select Option">Select Your Currency</option>
                                            <option value="united States Dollar" selected>USD</option>
                                            <option value="Armenian Dram">AMD</option>
                                            <option value="Australian Dollar" disabled>AUD</option>
                                            <option value="Austria">EUR</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col col-md-6">
                            <p class="header_hotline">Call us toll free: <strong>+1888 234 5678</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <div class="brand_logo">
                                <a class="brand_link" href="index-2.html">
                                    <img src="{{ asset('frontend/images/logo/logo_1x.png')}}" alt>
                                </a>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12">
                            <form action="#">
                                <div class="advance_serach">
                                    <div class="select_option mb-0 clearfix">
                                        <select>
                                            <option data-display="All Categories">Select A Category</option>
                                            <option value="1">New Arrival Products</option>
                                            <option value="2">Most Popular Products</option>
                                            <option value="3">Deals of the day</option>
                                            <option value="4">Mobile Accessories</option>
                                            <option value="5">Computer Accessories</option>
                                            <option value="6">Consumer Electronics</option>
                                            <option value="7">Automobiles & Motorcycles</option>
                                        </select>
                                    </div>
                                    <div class="form_item">
                                        <input type="search" name="search" placeholder="Search Prudcts...">
                                        <button type="submit" class="search_btn"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                            <button type="button" class="cart_btn">
                                <span class="cart_icon">
                                    <i class="icon icon-ShoppingCart"></i>
                                    <small class="cart_counter">3</small>
                                </span>
                                <span class="cart_amount">$909.00</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-3">
                            <div class="allcategories_dropdown">
                                <button class="allcategories_btn" type="button" data-bs-toggle="collapse" data-bs-target="#allcategories_collapse" aria-expanded="false" aria-controls="allcategories_collapse">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" aria-labelledby="statsIconTitle" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000"> <title id="statsIconTitle">Stats</title> <path d="M6 7L15 7M6 12L18 12M6 17L12 17"/> </svg>
                                    Browse categories
                                </button>
                                <div class="collapse {{ Route::is('frontend.home') ? 'show' : '' }}" id="allcategories_collapse">
                                    <div class="card card-body">
                                        <ul class="allcategories_list ul_li_block">
                                            @foreach ($categories->take(5) as $category)
                                            <li>
                                                <a href=""><i class="icon icon-Starship"></i> 
                                                    {{ $category->name }}</a>
                                            </li>
                                            @endforeach
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <nav class="main_menu navbar navbar-expand-lg">
                                <div class="main_menu_inner collapse navbar-collapse" id="main_menu_dropdown">
                                    <button type="button" class="offcanvas_close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                    <ul class="main_menu_list ul_li">
                                        <li class="dropdown">
                                            <a class="nav-link" href="#" id="shop_submenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Home</a>
                                            <ul class="submenu dropdown-menu" aria-labelledby="shop_submenu">
                                                <li><a href="index-2.html">Home default</a></li>
                                                <li><a href="index-3.html">Home style 2</a></li>
                                            </ul>
                                        </li>
                                        <li >
                                            <a class="nav-link" href="{{ route('frontend.shop.index') }}">Shop</a>
                                          
                                        </li>
                                        <li class="dropdown">
                                            <a class="nav-link" href="#" id="blog_submenu" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Blog </a>
                                            <ul class="submenu dropdown-menu" aria-labelledby="blog_submenu">
                                                <li><a href="blog.html">Blog Standard</a></li>
                                                <li><a href="blog-left-sidebar.html">Blog Left sidebar</a></li>
                                                <li><a href="blog-fullwidth.html">Blog Full width</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="nav-link" href="#" id="pages_submenu" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Pages </a>
                                            <ul class="submenu dropdown-menu" aria-labelledby="pages_submenu">
                                                <li><a href="about.html">About Us</a></li>
                                                <li><a href="team.html">Team</a></li>
                                                <li><a href="{{ route('user.dsahboard') }}">My Account</a></li>
                                                <li><a href="register.html">Register</a></li>
                                                <li class="dropdown">
                                                    <a href="#" id="cart_submenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shopping Cart</a>
                                                    <ul class="submenu dropdown-menu" aria-labelledby="cart_submenu">
                                                        <li><a href="cart.html">Cart</a></li>
                                                        <li><a href="cart_empty.html">Cart Empty</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="compare.html">Compare</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="order_tracking.html">Order Tracking</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="error.html">404 Error</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="nav-link" href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="offcanvas_overlay"></div>
                        </div>

                        <div class="col col-md-3">
                            <ul class="header_icons_group ul_li_right">
                                <li>
                                    <a href="contact.html">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="locationIconTitle">Location</title> <path d="M12,21 C16,16.8 18,12.8 18,9 C18,5.6862915 15.3137085,3 12,3 C8.6862915,3 6,5.6862915 6,9 C6,12.8 8,16.8 12,21 Z"/> <circle cx="12" cy="9" r="1"/>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="compare.html">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="rotateIconTitle">Rotate</title> <path d="M22 12l-3 3-3-3"/> <path d="M2 12l3-3 3 3"/> <path d="M19.016 14v-1.95A7.05 7.05 0 0 0 8 6.22"/> <path d="M16.016 17.845A7.05 7.05 0 0 1 5 12.015V10"/> <path stroke-linecap="round" d="M5 10V9"/> <path stroke-linecap="round" d="M19 15v-1"/> </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="wishlist.html">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg>
                                        <span class="wishlist_counter">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="personIconTitle">Person</title> <path d="M4,20 C4,17 8,17 10,15 C11,14 8,14 8,9 C8,5.667 9.333,4 12,4 C14.667,4 16,5.667 16,9 C16,14 13,14 14,15 C16,17 20,17 20,20"/> </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header_section - end
        ================================================== -->
        
        <!-- main body - start
        ================================================== -->
           <main>
            @yield('content')
           </main>
        <!-- main body - end
        ================================================== -->
        
        <!-- footer_section - start
        ================================================== -->
        <footer class="footer_section">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_about">
                                <div class="brand_logo">
                                    <a class="brand_link" href="index-2.html">
                                        <img src="{{ asset('frontend/images/logo/logo_1x.png')}}" alt>
                                    </a>
                                </div>
                                <ul class="social_round ul_li">
                                    <li><a href="#!"><i class="icofont-youtube-play"></i></a></li>
                                    <li><a href="#!"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#!"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#!"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#!"><i class="icofont-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                                <ul class="ul_li_block">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Sign Up</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Custom area</h3>
                                <ul class="ul_li_block">
                                    <li><a href="#!">My Account</a></li>
                                    <li><a href="#!">Orders</a></li>
                                    <li><a href="#!">Tracking List</a></li>
                                    <li><a href="#!">Tearm</a></li>
                                    <li><a href="#!">Privacy Policy</a></li>
                                    <li><a href="#!">My Cart</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_contact">
                                <h3 class="footer_widget_title text-uppercase">Contact Onfo</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </p>
                                <div class="hotline_wrap">
                                    <div class="footer_hotline">
                                        <div class="item_icon">
                                            <i class="icofont-headphone-alt"></i>
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Have any question?</h4>
                                            <span class="hotline_number">+ 123 456 7890</span>
                                        </div>
                                    </div>
                                    <div class="livechat_btn clearfix">
                                        <a class="btn border_primary" href="#!">Live Chat</a>
                                    </div>
                                </div>
                                <ul class="store_btns_group ul_li">
                                    <li><a href="#!"><img src="{{ asset('frontend/images/app_store.png')}}" alt="app_store"></a></li>
                                    <li><a href="#!"><img src="{{ asset('frontend/images/play_store.png')}}" alt="play_store"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <p class="copyright_text">
                                ©2021 <a href="#!">stowaa</a>. All Rights Reserved.
                            </p>
                        </div>
                        
                        <div class="col col-md-6">
                            <div class="payment_method">
                                <h4>Payment:</h4>
                                <img src="{{ asset('frontend/images/payments_icon.png')}}" alt="image_not_found">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer_section - end
        ================================================== -->

    </div>
    <!-- body_wrap - end -->

    <!-- fraimwork - jquery include -->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/js/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>

    <!-- carousel - jquery plugins collection -->
    <script src="{{ asset('frontend/js/jquery-plugins-collection.js')}}"></script>

    <!-- google map  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&amp;ver=2.1.6"></script>
    <script src="{{ asset('frontend/js/gmaps.min.js')}}"></script>

    <!-- custom - main-js -->
    <script src="{{ asset('frontend/js/main.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>


    @yield('script')

    @include('flashmessage')

</body>

</html>