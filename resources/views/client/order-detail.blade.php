@extends('layouts.client.index')
@section('title', 'Order Detail')
@section('styles')

    <style>
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }

        .text-reset {
            --bs-text-opacity: 1;
            color: inherit !important;
        }

        a {
            color: #5465ff;
            text-decoration: none;
        }

        .card {
            z-index: 0;
            /*padding-bottom: 20px;*/
            /*margin-top: 90px;*/
            /*margin-bottom: 90px;*/
            /*border-radius: 10px;*/
        }

        .track-line {
            height: 2px !important;
            background-color: #488978;
            opacity: 1;
        }

        .dot {
            height: 10px;
            width: 10px;
            margin-left: 3px;
            margin-right: 3px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block
        }

        .big-dot {
            height: 25px;
            width: 25px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block;
        }

        .big-dot i {
            font-size: 12px;
        }

        .card-stepper {
            z-index: 0
        }

    </style>
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="container mb-5">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('client.home')}}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('client.profile')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Profile <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">Order Detail</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0">Invoice #{{ $values['order']->order_code }}&emsp;-&emsp;{{ $values['order']->order_date }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-header text-black" style="background: #fff; border-radius: 10px 10px 0 0">
                            Order Items
                        </div>
                        <div class="card-body " style="overflow: auto;">
                            <div class="table-responsive " style="min-width: 800px">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($values['order_detail'] as $item_order)
                                        <tr>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0 mr-2">
                                                        <img src="{{ $item_order->product['image'] }}" alt="" width="35" class="img-fluid">
                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item_order->product['name'] }}</a></h6>
                                                        <span class="small">Size: {{ $item_order->options['size'] }}</span>&nbsp;-&nbsp;
                                                        <span class="small">Color: {{ $item_order->options['color'] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item_order->getOrderDetailMoneyItemFormatAttribute()}}</td>
                                            <td>{{ $item_order->quantity }}</td>
                                            <td>{{ $item_order->getOrderDetailMoneyTotalItemFormatAttribute() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Subtotal:</th>
                                            <th><b>{{ $values['order']->getSubtotalFormatAttribute() }}</b> </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header text-black" style="background: #fff; border-radius: 10px 10px 0 0">
                            Tracking Order
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                @if ($values['order']->tracking == 0)
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @elseif ($values['order']->tracking == 1)
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @elseif ($values['order']->tracking == 2)
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @elseif ($values['order']->tracking == 3)
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                @endif
                            </div>

                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div class="d-flex flex-column align-items-start"><span>Order placed</span></div>
                                <div class="d-flex flex-column justify-content-center align-items-center"><span>Preparing orders</span></div>
                                <div class="d-flex flex-column align-items-center"><span>Out for delivery</span></div>
                                <div class="d-flex flex-column align-items-end"><span>Item received</span></div>
                            </div>
                        </div>
                    </div>
                    @if($values['order']->tracking == 2)
                        <div class="card mb-4">
                            <div class="card-header text-black" style="background: #fff; border-radius: 10px 10px 0 0">
                                Order received
                            </div>
                            <div class="card-body">
                            <div class="card-body">
                                <button class="btn btn-success">Order received</button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Payment Method &emsp;
                                @if($values['order']->status_payment == 0)
                                    @if($values['order']->payment_method == 0)
                                    @else
                                        <span class="badge rounded-pill bg-secondary">Wait for pay</span>
                                    @endif
                                @elseif($values['order']->status_payment == 1)
                                    <span class="badge rounded-pill bg-success">Payment success</span>
                                @elseif($values['order']->status_payment == 2)
                                    <span class="badge rounded-pill bg-danger">Payment canceled</span>
                                @endif
                            </h3>
                            <strong>
                                @if($values['order']->payment_method == 0)
                                    Cash on delivery
                                @elseif($values['order']->payment_method == 1)
                                    VIETQR
                                @elseif($values['order']->payment_method == 2)
                                    VNPAY
                                @endif
                            </strong>
                            <hr>
                            <h3 class="h6">Shipping Information</h3>
                            <strong>J&T</strong>
                            <span><a href="https://jtexpress.vn/vi/tracking?type=track&billcode=1298376192873612" class="text-decoration-underline" target="_blank">1298376192873612</a> <i class="bi bi-box-arrow-up-right"></i> </span>
                            <hr>
                            <h3 class="h6">Address</h3>
                            <address>
                                <strong>Name: </strong>{{$values['order']->user['name']}}
                                <br>
                                <strong>Address: </strong>{{$values['order']->user['address']}}
                                <br>
                                <strong>Phone: </strong>{{$values['order']->user['phone']}}
                            </address>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header text-black" style="background: #fff; border-radius: 10px 10px 0 0">Note</div>
                        <div class="card-body">
                            <p>
                                {{ $values['order']->note }}
                            </p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-header text-black" style="background: #fff; border-radius: 10px 10px 0 0">
                            Total order amount
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Subtotal
                                    <span class="text-end">{{ $values['order']->getSubtotalFormatAttribute() }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Shipping
                                    <span class="text-end">{{ $values['order']->getShippingFormatAttribute() }}</span>
                                </li>
                                @if($values['order']->promotion != null)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Discount (Code: {{ $values['order']->promotion['coupon'] }})
                                        <span class="text-danger text-end">-{{ $values['order']->getDiscountFormatAttribute() }}</span>
                                    </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>TOTAL</strong>
                                    <span class="text-end"><b>{{ $values['order']->getTotalFormatAttribute() }}</b></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
