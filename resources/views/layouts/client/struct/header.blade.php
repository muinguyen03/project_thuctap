<style>
    .dropdown-toggle:after {
        display: none;
    }
</style>
<header class="{{ request()->is('/') ? '' : 'header-v4' }}">
    <div class="container-menu-desktop">
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">Welcome</div>
                <div class="right-top-bar flex-w h-full">
                    @unless (Auth::check())
                        <div class="btn-group">
                            <button type="button" class="flex-c-m trans-04 p-lr-25 dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="z-index: 999999">
                                <a class="dropdown-item" style="color: #000" href="{{ route('auth.login') }}"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</a>
                                <a class="dropdown-item" style="color: #000" href="{{ route('auth.register') }}"><i class="fa-solid fa-user-plus"></i>&nbsp;Register</a>
                            </div>
                        </div>
                    @endunless

                    @unless (!Auth::check())
                        <div class="btn-group">
                            <button type="button" class="flex-c-m trans-04 p-lr-25 dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Chào, {{Auth::user()->name}}&nbsp;<img width="30px" height="30px" style="border-radius: 50%" src="{{Auth::user()->image}}" alt="Avatar User">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="z-index: 999999">
                                @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                                    <a class="dropdown-item" style="color: #000" href="{{ url('admin') }}"><i class="fa-solid fa-fire"></i>&nbsp;Admin</a>
                                @endif
                                <a class="dropdown-item" style="color: #000" href="{{ route('client.profile') }}"><i class="fa-regular fa-user"></i>&nbsp;Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="color: red" href="{{ route('auth.logout') }}"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
                            </div>
                        </div>
                    @endunless

                </div>
            </div>
        </div>
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <a href="{{route('client.home')}}" class="logo"><img src="{{asset('assets/client/images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ request()->is('/') ? 'active-menu' : '' }}"><a href="{{route('client.home')}}">Home</a></li>
                        <li class="{{ request()->is('shop') ? 'active-menu' : '' }}"><a href="{{route('client.shop')}}">Shop</a></li>
                        <li class="{{ request()->is('about') ? 'active-menu' : '' }}"><a href="{{route('client.about')}}">About</a></li>
                        <li class="{{ request()->is('contact') ? 'active-menu' : '' }}"><a href="{{route('client.contact')}}">Contact</a></li>
                        @if(request()->is('cart'))<li class="active-menu"><a>Shopping Cart</a></li>@endif
                        @if(request()->is('checkout'))<li class="active-menu"><a>Checkout</a></li>@endif
                        @if(request()->is('profile'))<li class="active-menu"><a>Profile</a></li>@endif
                    </ul>
                </div>
                <div class="wrap-icon-header flex-w flex-r-m">
                    @if(!request()->is('search'))
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search"><i class="zmdi zmdi-search"></i></div>
                    @endif
                    @unless (!Auth::check())
                        @if(!request()->is('cart') && !request()->is('checkout'))
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" id="header-cart" data-notify=""><i class="zmdi zmdi-shopping-cart"></i></div>
                        @endif
                    @endunless
                </div>
            </nav>
        </div>
    </div>
    <div class="wrap-header-mobile">
        <div class="logo-mobile">
            <a href="{{route('client.home')}}"><img src="{{asset('assets/client/images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
        </div>
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            @if(!request()->is('search'))
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>
            @endif
            @unless (!Auth::check())
                @if(!request()->is('cart') && !request()->is('checkout'))
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" id="header-mobile-cart" data-notify="">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                @endif
            @endunless
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li><a href="{{route('client.home')}}">Home</a></li>
            <li><a href="{{route('client.shop')}}">Shop</a></li>
            <li><a href="{{route('client.about')}}">About</a></li>
            <li><a href="{{route('client.contact')}}">Contact</a></li>
            <hr>


            @unless (Auth::check())
                <li>
                    <a href="#">Account</a>
                    <ul class="sub-menu-m">
                        <li><a href="{{route('auth.login')}}">Login</a></li>
                        <li><a href="{{route('auth.register')}}">Register</a></li>
                    </ul>
                    <span class="arrow-main-menu-m"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </li>
            @endunless
            @unless (!Auth::check())
                @unless (Auth::user()->role != 0)
                    <li>
                        <a href="#">Hello, {{Auth::user()->name}}</a>
                        <ul class="sub-menu-m">
                            <li><a href="{{ url('admin') }}">Admin</a></li>
                            <li><a href="{{ route('client.profile') }}">Profile</a></li>
                            <li><a style="color: red" href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                        <span class="arrow-main-menu-m"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </li>
                @endunless
            @endunless


        </ul>
    </div>
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search"><img src="{{asset('assets/client/images/icons/icon-close2.png')}}" alt="CLOSE"></button>
            <form class="wrap-search-header flex-w p-l-15" action="{{route('client.search')}}">
                <button class="flex-c-m trans-04"><i class="zmdi zmdi-search"></i></button>
                <input class="plh3" type="text" name="q" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
<div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full" id="header-cart-list">
                </ul>
                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40" >
                        Total: <span id="total"></span>
                    </div>
                    <div class="header-cart-buttons flex-w w-full">
                        <a href="{{route('client.cart')}}" id="show-cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>
                        <a href="{{route('client.checkout')}}" id="checkout"  class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


