@extends('layouts.client.index')
@section('title', 'Shopping Cart')
@section('styles')

@stop
@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('client.home')}}" class="stext-109 cl8 hov-cl1 trans-04">Home<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i></a>
            <span class="stext-109 cl4">Shoping Cart</span>
        </div>
    </div>
    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <thead>
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2">Options</th>
                                        <th class="column-3">Quantity</th>
                                        <th class="column-4">Total</th>
                                        <th class="column-5">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTbody">
                                    <tr class="table_row"><td class="column-1 text-center" colspan="6">Loading ...</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex bor15 p-t-18 p-b-18 p-l-20" id="div-clear-cart">
                            <button id="reload-cart" style="width: 150px" class="btn btn-secondary">Reload cart</button>
                            <button id="clear-cart" style="width: 120px" class="btn btn-danger">Clear cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>
                        <div class="flex-w flex-t p-t-27">
                            <div class="size-208"><span class="mtext-101 cl2">Item:</span></div>
                            <div class="size-209 p-t-1"><span class="mtext-110 cl2" id="itemCount"></span></div>
                        </div>
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208"><span class="mtext-101 cl2">Total:</span></div>
                            <div class="size-209 p-t-1"><span class="mtext-110 cl2" id="total2"></span></div>
                        </div>
                        <a href="{{route('client.checkout')}}" id="checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

