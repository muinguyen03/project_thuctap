@extends('layouts.client.index')
@section('title', 'Product Detail - ' . $product_detail->name)
@section('content')
@php
    $tab = $_GET['tab'] ?? null;
@endphp
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('client.home')}}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('client.shop')}}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product_detail->getCategoryProductAttribute() }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{ $product_detail->name }}
			</span>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach($product_images as $item)
                                    <div class="item-slick3" data-thumb="{{ $item->getImgProductAttribute() }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $item->getImgProductAttribute() }}" alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                               href="{{ $item->getImgProductAttribute() }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product_detail->name }}
                        </h4>

                        <span class="mtext-106 cl2">
							{{ $product_detail->getMoneyFormatAttribute() }}
						</span>

                        @if($product_detail->description_sort)
                            @if($product_detail->description_sort != null)
                                <p class="stext-102 cl3 p-t-23">
                                    Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare
                                    feugiat.
                                </p>
                            @endif
                        @endif


                        <!--  -->
                        <div class="p-t-33">
                            <form onsubmit="return false">
                                <input type="hidden" id="id_product" value="{{$product_detail->id}}">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">Size</div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" id="size" name="size">
                                                <option value="" selected>Choose size</option>
                                                @foreach($product_detail->size as $key => $size)
                                                    <option value="{{ $key }}">{{ $size }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">Color</div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" id="color" name="color">
                                                <option value="" selected>Choose color</option>
                                                @foreach($product_detail->color as $key => $color)
                                                    <option value="{{ $key }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                   id="quantity" name="quantity" value="1" min="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        @unless(!Auth::check())
                                            <button type="submit" id="addCart" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                Add to cart
                                            </button>
                                        @endunless


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs" role="tablist" >
                        <li class="nav-item p-b-10" onclick="changeUrlWithoutReloading('{{ route('client.product_detail', $product_detail) }}')">
                            <a class="nav-link {{ ($tab === null) ? 'active' : '' }}" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>

                        <li class="nav-item p-b-10" onclick="changeUrlWithoutReloading('{{ route('client.product_detail', $product_detail).'?tab=information' }}')">
                            <a class="nav-link {{ ($tab === 'information') ? 'active' : '' }}" data-toggle="tab" href="#information" role="tab">Information</a>
                        </li>

                        <li class="nav-item p-b-10" onclick="changeUrlWithoutReloading('{{ route('client.product_detail', $product_detail).'?tab=reviews' }}')">
                            <a class="nav-link {{ ($tab === 'reviews') ? 'active' : '' }}" data-toggle="tab" href="#reviews" role="tab">Reviews ({{count($rate)}})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade {{ ($tab === null) ? 'show active' : '' }}" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product_detail->description ?? 'No description' }}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade {{ ($tab === 'information') ? 'show active' : '' }}" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">Weight</span>
                                            <span class="stext-102 cl6 size-206">
                                                {{ $product_detail->weight ?? 'No weight' }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">Dimensions</span>
                                            <span class="stext-102 cl6 size-206">
                                                {{ $product_detail->dimensions ?? 'No dimensions' }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">Materials</span>
                                            <span class="stext-102 cl6 size-206">
                                                {{ $product_detail->materials ?? 'No materials' }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">Color</span>
                                            <span class="stext-102 cl6 size-206">
                                                @foreach($product_detail->color as $color)
                                                    {{ $color }},
                                                @endforeach
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">Size</span>
                                            <span class="stext-102 cl6 size-206">
                                                @foreach($product_detail->size as $size)
                                                    {{ $size }},
                                                @endforeach
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade {{ ($tab === 'reviews') ? 'show active' : '' }}" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @foreach($rate as $item)
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6"><img src="{{$item->user['image']}}" alt="AVATAR"></div>
                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <span class="mtext-107 cl2 p-r-20">{{$item->user['name']}}</span>
                                                        <span class="fs-18 cl11">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $item->star)
                                                                    <i class="zmdi zmdi-star"></i>
                                                                @else
                                                                    <i class="zmdi zmdi-star-outline"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <p class="stext-102 cl6">
                                                        {{$item->content}}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach


                                        @if(Auth::check())
                                            @if($product_detail->checkRateExistAttribute())
                                                Bạn đã đánh giá sản phẩm này rồi !
                                            @else
                                                <form class="w-full" action="{{ route('client.rate.add') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                                                    <h5 class="mtext-108 cl2 p-b-7">Add a review</h5>
                                                    <div class="flex-w flex-m p-t-50 p-b-23">
                                                        <span class="stext-102 cl3 m-r-16">Your Rating</span>
                                                        <span class="wrap-rating fs-18 cl11 pointer">
                                                            @for($i = 1 ; $i <= 5 ; $i++)
                                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @endfor
                                                            <input class="dis-none" type="number" name="rating">
                                                        </span>
                                                    </div>

                                                    <div class="row p-b-25">
                                                        <div class="col-12 p-b-5">
                                                            <label class="stext-102 cl3" for="review">Your review</label>
                                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">Submit</button>
                                                </form>
                                            @endif
                                        @else
                                            Vui lòng đăng nhập để đánh giá sản phẩm !
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: {{ $product_detail->sku ?? '' }}
            </span>
            <span class="stext-107 cl6 p-lr-25">
				Categories: {{ $product_detail->getCategoryProductAttribute() }}
			</span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            @if(count($product_related) > 0)
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach($product_related as $key => $item)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{asset('assets/client/images/product-01.jpg')}}" alt="IMG-PRODUCT">
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('client.product_detail',1)}}}}"
                                           class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$item->name}}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {{$item->getMoneyFormatAttribute()}}
									    </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04"
                                                 src="{{asset('assets/client/images/icons/icon-heart-01.png')}}"
                                                 alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                 src="{{asset('assets/client/images/icons/icon-heart-02.png')}}"
                                                 alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
                <div class="text-center">
                    <p>No Product !</p>

                </div>
            @endif
        </div>
    </section>
    <script>
        const id = '{{ request()->route('id') }}'
        console.log(id)
    </script>
@stop

