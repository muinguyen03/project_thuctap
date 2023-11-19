@extends('layouts.client.index')
@section('title', 'Checkout')
@section('styles')
    <style>
        .labl {
            display : block;
            width: 220px;
        }
        .labl > input{ /* HIDE RADIO */
            visibility: hidden; /* Makes input not-clickable */
            position: absolute; /* Remove input from document flow */
        }
        .labl > input + div{ /* DIV STYLES */
            cursor:pointer;
            border:2px solid transparent;
        }
        .labl > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
            background-color: #ffd6bb;
            border: 1px solid #ff6600;
        }
        .img_payment {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('client.home')}}" class="stext-109 cl8 hov-cl1 trans-04">Home<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i></a>
            <span class="stext-109 cl4">Checkout</span>
        </div>
    </div>
    <div class="container mb-5">
        <div class="py-5 text-center"><h2>Checkout</h2></div>
            <form onsubmit="return false" class="form" id="checkout-form">
                <div class="row">
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Billing information</h4>
                        <div class="d-block">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" value="{{Auth::user()->name}}">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" value="{{Auth::user()->phone != '' ? Auth::user()->phone : ''}}">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" value="{{Auth::user()->address != '' ? Auth::user()->address : ''}}">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="address">Note</label>
                                <textarea name="note" id="note" cols="30" rows="5"  class="form-control" ></textarea>
                            </div>
                            <div class="mt-5 mb-5"></div>
                        </div>
                        <h4 class="mb-3">Payment</h4>
                        <div class="d-block mb-5 d-flex flex-wrap">
                            <label class="labl p-r-5">
                                <input type="radio" name="payment_method" class="pay_method" value="0" checked="checked"/>
                                <div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center lh-condensed">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1554/1554401.png" alt="" class="img_payment rounded"/>
                                                <div style="margin-left: 5px">
                                                    <h6 class="my-0">Cash on delivery</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </label>
                            <label class="labl p-r-5">
                                <input type="radio" name="payment_method" class="pay_method" value="1"/>
                                <div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center lh-condensed">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="https://www.vietqr.io/img/vietqr%20api%20-%20payment%20kit.png" alt="" class="img_payment rounded"/>
                                                <div style="margin-left: 5px">
                                                    <h6 class="my-0">Scan QR Code</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </label>
                            <label class="labl">
                                <input type="radio" name="payment_method" class="pay_method" value="2"/>
                                <div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center lh-condensed">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Icon-VNPAY-QR.png" alt="" class="img_payment rounded"/>
                                                <div style="margin-left: 5px">
                                                    <h6 class="my-0">VNPAY</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3"><span class="text-muted">Items</span></h4>
                        <ul class="list-group mb-3" id="checkout-cart">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </ul>
                        <hr>
                        <div id="coupon"></div>
                        <input type="hidden" id="value_coupon">
                        <input type="hidden" id="value_coupon_discount">
                        <hr>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between" style="border: none">
                                <p>Subtotal</p>
                                <h6 id="subtotal"></h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between" style="border: none">
                                <p>Shipping</p>
                                <h6 id="shipping"></h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between" id="show_coupon" style="border: none"></li>
                            <li class="list-group-item d-flex justify-content-between" style="border: none">
                                <input type="hidden" id="value_total">
                                <p><strong>Total</strong></p>
                                <h5><strong id="total_checkout"></strong></h5>
                            </li>
                        </ul>
                        <hr>
                        <div id="btn-order"></div>
                    </div>
                </div>
            </form>
    </div>
@stop
@section('scripts')
    <script src="{{ asset('assets/js/validate/checkout.js') }}"></script>
@stop
