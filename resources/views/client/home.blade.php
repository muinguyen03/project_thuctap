@extends('layouts.client.index')
@section('title', 'Home')
@section('content')
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">

                @foreach($banners as $key => $item)

                    <div class="item-slick1" style="background-image: url({{ $item->getImageBannerAttribute() }});">

                        @if($key == 0)
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        Women Collection 2023
                                    </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                            NEW SEASON
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                        <a href="{{route('client.shop')}}"
                                           class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @elseif($key == 1)
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                        <span class="ltext-101 cl2 respon2">
                                            Men New-Season
                                        </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn"
                                         data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                            Jackets & Coats
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                        <a href="{{route('client.shop')}}"
                                           class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @elseif($key == 2)
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft"
                                         data-delay="0">
                                        <span class="ltext-101 cl2 respon2">
                                            Men Collection 2023
                                        </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight"
                                         data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                            New arrivals
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                        <a href="{{route('client.shop')}}"
                                           class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Banner -->
    <div class="d-none sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{asset('assets/client/images/banner-01.jpg')}}" alt="IMG-BANNER">

                        <a href="{{route('client.shop')}}"
                           class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Women
								</span>

                                <span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{asset('assets/client/images/banner-02.jpg')}} " alt="IMG-BANNER">

                        <a href="{{route('client.shop')}}"
                           class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Men
								</span>

                                <span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{asset('assets/client/images/banner-03.jpg')}}" alt="IMG-BANNER">
                        <a href="{{route('client.shop')}}"
                           class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Accessories
								</span>

                                <span class="block1-info stext-102 trans-04">
									New Trend
								</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product -->
    <section class="mt-5 bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10 mb-5">
                <h3 class="ltext-103 cl5">
                    Product Feature
                </h3>
            </div>
            <div>
                <section class="sec-relate-product bg0 p-t-45 p-b-105">
                    <div class="container">
                        <!-- Slide2 -->
                        <div class="wrap-slick2">
                            <div class="slick2">
                                @foreach ($products as $key => $product)

                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                        <div class="block2">
                                            <div class="block2-pic hov-img0">
                                                <img src="{{$product->getImgAttribute()}}" alt="IMG-PRODUCT">
                                            </div>

                                            <div class="block2-txt flex-w flex-t p-t-14">
                                                <div class="block2-txt-child1 flex-col-l ">
                                                    <a href="{{route('client.product_detail',$product)}}"
                                                       class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                        {{$product->name}}
                                                    </a>

                                                    <span class="stext-105 cl3">
                                                        {{ $product->getMoneyFormatAttribute() }}
                                                    </span>
                                                </div>

                                                <div class="block2-txt-child2 flex-r p-t-3">
                                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                        <img class="icon-heart1 dis-block trans-04" src="{{asset('assets/client/images/icons/icon-heart-01.png')}}"
                                                             alt="ICON">
                                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                             src="{{asset('assets/client/images/icons/icon-heart-02.png')}}" alt="ICON">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>



@stop

