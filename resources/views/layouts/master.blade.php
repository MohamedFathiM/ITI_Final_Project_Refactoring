<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>{{ config('app.name') }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('/img/core-img/favicon.ico')}}">
  
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('/css/core-style.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
@yield('style')
<link rel="stylesheet" href="{{asset('/css/star-rating.min.css')}}" />
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">


</head>

<body >
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                    <form action="{{route('searchproduct')}}" method="post" role="search"  >
                                 {{csrf_field()}}
                            <input type="search" name="q"  id="search" placeholder="Type your keyword..." value="{{ old('search') }}" >
                            <button type="submit"><img src="/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- Search Wrapper Area End -->

 <!-- ##### Main Content Wrapper Start ##### -->
 <div class="main-content-wrapper d-flex clearfix">

<!-- Mobile Nav (max width 767px)-->
<div class="mobile-nav">
    <!-- Navbar Brand -->
    <div class="amado-navbar-brand">
        <a href="{{route('home')}}"><img src="/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Navbar Toggler -->
    <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
    </div>
</div>

 <!-- Header Area Start -->
 <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
            <a href="{{route('home')}}"><img src="/img/core-img/logo.png" alt=""></a>


            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                        @guest
                        <li class="nav-item {{Request::is('login') ? 'active' : '' }}" >
                            <a class="nav-link" href="{{ url('/login') }}" style="color:green;">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item {{Request::is('register') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/register') }}" style="color:green;">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown " >
                            <a style="color:green;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Hello {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                
                            <div class="dropdown-menu dropdown-menu-left " id="dropMenu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " id="logout" href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                
                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <br>
                    <li class="{{Request::is('/') ? 'active' : '' }}"><a href="{{route('home')}}">Home</a></li>
                    <li class="{{Request::is('shop/1') ? 'active' : '' }}"><a href="{{url('shop/1')}}">Shop</a></li>
                    <li class="{{Request::is('product/1') ? 'active' : '' }}"><a href="{{url('product/1')}}">Product</a></li>
                    <li class="{{Request::is('cart') ? 'active' : '' }}"><a href="{{route('cart')}}">Cart</a></li>
                    <li class="{{Request::is('checkout') ? 'active' : '' }}"><a href="{{route('checkout')}}">Checkout</a></li>

                     <!-- Right Side Of Navbar -->
    <!-- Authentication Links -->
    



                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="{{route('thisweek')}}" class="btn amado-btn active">New this week</a>
                <br>
                @if(\Auth::check())
                @if(\Auth::user()->role == 0)
                <a href="{{route('index')}}" class="btn amado-btn active">Dashboard</a>
                @endif
                @endif
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="{{route('cart')}}" class="cart-nav"><img src="/img/core-img/cart.png" alt=""> Cart <span>( @if(\Auth::check()){{App\Cart::where('user_id',auth()->user()->id)->count()}} @endif )</span></a>
                <a href="{{url('favourite')}}" class="fav-nav"><img src="/img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="/img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

@yield('content')

  <!-- ##### Newsletter Area Start ##### -->
  <section class="newsletter-area section-padding-100-0" style="width:100%">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>Offers && Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                    <form action="{{route('subscribe')}}" method="post">
                            @csrf
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                        @if (count($errors) > 0)

                        <div class="alert alert-danger">
                    
                            <strong>Whoops!</strong> There were some problems with your input.
                    
                            <ul>
                    
                                @foreach ($errors->all() as $error)
                    
                                    <li>{{ $error }}</li>
                    
                                @endforeach
                    
                            </ul>
                    
                        </div>
                       
                    @endif
                    @if(Session::get('message'))
                    <div class="alert alert-success" style="background-color:goldenrod">
                    <strong>
                    {{Session::get('message')}}
                    </strong>
                    </div>
                    @endif
                    </div>
          
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->


 <!-- ##### Footer Area Start ##### -->
 <footer class="footer_area clearfix" style="width:100%">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="{{route('home')}}"><img src="/img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://github.com/MohamedFathiM/Final-Project" target="_blank">Iti(Eagles)</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                    <li class="nav-item {{Request::is('/')?'active':''}}">
                                            <a class="nav-link" href="{{route('home')}}">Home</a>
                                        </li>
                                        <li class="nav-item {{Request::is('shop/1')?'active':''}}">
                                            <a class="nav-link" href="{{url('shop/1')}}">Shop</a>
                                        </li>
                                        <li class="nav-item {{Request::is('product/1')?'active':''}}">
                                            <a class="nav-link" href="{{url('product/1')}}">Product</a>
                                        </li>
                                        <li class="nav-item {{Request::is('cart')?'active':''}}">
                                            <a class="nav-link" href="{{route('cart')}}">Cart</a>
                                        </li>
                                        <li class="nav-item {{Request::is('checkout')?'active':''}}">
                                            <a class="nav-link" href="{{route('checkout')}}">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="{{asset('/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
 
    <script src="{{asset('/js/bootstrap4.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('/js/plugins.js')}}"></script>
    <script src="{{asset('/js/star-rating.min.js')}}"></script>

    <!-- Active js -->
    <script src="{{asset('/js/active.js')}}"></script>

    @yield('script')
</body>

</html>