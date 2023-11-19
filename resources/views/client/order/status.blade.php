@extends('layouts.client.index')
@section('title', 'Order Status')
@section('styles')
@stop
@section('content')
    <div class="container m-5 mx-auto">
        @if($values['order']->status_payment == 0 || $values['order']->status_payment == 1)
            <div class="d-flex align-items-center justify-content-center mb-5">
                <div class="swal2-icon swal2-success swal2-animate-success-icon m-3" style="display: flex;">
                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                    <span class="swal2-success-line-tip"></span>
                    <span class="swal2-success-line-long"></span>
                    <div class="swal2-success-ring"></div>
                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>
                <h1>Order Successfully 🎊🎉</h1>
            </div>
        @elseif($values['order']->status_payment == 2 || $values['order']->status_payment == 3)
            <div class="d-flex align-items-center justify-content-center mb-5">
                <div class="swal2-icon swal2-error swal2-animate-error-icon m-3" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                <h1>Order Failed 😥</h1>
            </div>
        @endif
        <div class="row">
            <div class="{{ $values['order']->payment_method == 1 && $values['order']->status_payment == 0 ? 'col-9' : ''}}">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mt-3 mb-5">
                                <h6 class="mb-3">Invoice</h6>
                                <div><b>#{{ $values['order']->order_code }}</b></div>
                                <div>Time: {{ $values['order']->order_date }}</div>
                            </div>
                            <div class="col-sm-3 mt-3 mb-5">
                                <h6 class="mb-3">Shipment Details</h6>
                                <div>
                                    <strong>{{$values['order']->user['name']}}</strong>
                                </div>
                                <div>{{$values['order']->user['address']}}</div>
                                <div>Phone: {{$values['order']->user['phone']}}</div>
                            </div>
                            <div class="col-sm-3 mt-3 mb-5">
                                <h6 class="mb-3">Payment</h6>
                                <div>
                                    <strong> @if($values['order']->payment_method == 0)
                                        Cash on delivery
                                    @elseif($values['order']->payment_method == 1)
                                        VIETQR
                                    @elseif($values['order']->payment_method == 2)
                                        VNPAY
                                    @endif</strong>
                                </div>
                                <div class="mt-2">
                                    @if($values['order']->status_payment == 0)
                                        @if($values['order']->payment_method == 0)
                                        @else
                                            <span class="badge rounded-pill bg-secondary">Wait for pay</span>
                                        @endif
                                    @elseif($values['order']->status_payment == 1)
                                        <span class="badge rounded-pill bg-success">Payment success</span>
                                    @elseif($values['order']->status_payment == 2)
                                        <span class="badge rounded-pill bg-danger">Payment canceled</span>
                                    @elseif($values['order']->status_payment == 3)
                                        <span class="badge rounded-pill bg-danger">Error Payment</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="center">Image</th>
                                        <th class="center">Name</th>
                                        <th class="center">Options</th>
                                        <th class="right">Price</th>
                                        <th class="center">Quantity</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($values['order_detail'] as $item_order)
                                        <tr>
                                            <td>
                                                <img src="{{ $item_order->product['image'] }}" alt="" width="50" class="img-fluid">
                                            </td>
                                            <td class="left">{{ $item_order->product['name'] }}</td>
                                            <td class="left">Size: {{ $item_order->options['size'] }} <br> Color: {{ $item_order->options['color'] }}</td>
                                            <td class="right">{{ $item_order->getOrderDetailMoneyItemFormatAttribute()}}</td>
                                            <td class="center">{{ $item_order->quantity }}</td>
                                            <td class="right">{{ $item_order->getOrderDetailMoneyTotalItemFormatAttribute() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="right">{{ $values['order']->getSubtotalFormatAttribute() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Shipping</strong>
                                            </td>
                                            <td class="right">{{ $values['order']->getShippingFormatAttribute() }}</td>
                                        </tr>
                                        @if($values['order']->promotion != null)
                                            <tr>
                                                <td class="left">
                                                    <strong> Discount (Code: {{ $values['order']->promotion['coupon'] }})</strong>
                                                </td>
                                                <td class="right"><del>-{{ $values['order']->getDiscountFormatAttribute() }}</del></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="left">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong>{{ $values['order']->getTotalFormatAttribute() }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($values['order']->payment_method == 1 && $values['order']->status_payment == 0)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="https://img.vietqr.io/image/mb-0823565831-compact.jpg?amount={{ $values['order']->total }}&addInfo=COZAOC{{ $values['order']->order_code }}" width="100%" alt="">
                            <div class="mt-3 mb-3">Quý khách vui lòng thanh toán theo mã QR code trên để hoàn tất đơn hàng</div>
                            <ol class="list-group list-group-light list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        Chủ tài khoản
                                    </div>
                                    NGUYEN THIEN DUC
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        Nội dung
                                    </div>
                                    COZAOC{{ $values['order']->order_code }}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        Số tiền:
                                    </div>
                                    {{ $values['order']->getTotalFormatAttribute() }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
