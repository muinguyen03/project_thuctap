@extends('layouts.client.index')
@section('title', 'Shop')
@section('content')
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">All Products</button>
                    @foreach($categories as $category)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$category->name_category}}">{{$category->name_category}}</button>
                    @endforeach
                </div>


            </div>

            <div class="row isotope-grid rounded">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item rounded {{ $product->getCategoryProductAttribute() }} ">
                        <div class="block2 rounded">
                            <div class="block2-pic hov-img0"><img class="rounded" src="{{$product->getImgAttribute()}}" alt="IMG-PRODUCT"></div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('client.product_detail',$product)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">{{$product->name}}</a>
                                    <span class="stext-105 cl3">{{ $product->getMoneyFormatAttribute() }}</span>
                                </div>
                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="{{asset('assets/client/images/icons/icon-heart-01.png')}}" alt="ỉcon">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('assets/client/images/icons/icon-heart-02.png')}}" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <ul class="pagination">
                    {{$products->links()}}
                </ul>
            </div>
        </div>
    </div>
@stop
