@extends('layouts.admin.index')
@section('title', 'Products Create')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        @component('admin.components.breadcrumb')
            @slot('title')
                Invoice #{{ $order->order_code }}
            @endslot
        @endcomponent
        @component('admin.components.button.back')
            @slot('url')
                order
            @endslot
        @endcomponent
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Order Info</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">#{{ $order->order_code }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">{{ $order->order_date }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">User</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">{{ $order->user['name'] }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Phone</th>
                                <th scope="col">{{ $order->user['phone'] }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Address</th>
                                <th scope="col">{{ $order->user['address'] }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Note</div>
                <div class="card-body">
                    {{ $order->note }}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Payment</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Method</th>
                                <th scope="col">
                                    @if ($order->payment_method == 0)
                                        Cash on delivery
                                    @elseif ($order->payment_method == 1)
                                        VietQR
                                    @elseif ($order->payment_method == 2)
                                        VNPAY
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">
                                    @if ($order->status_payment == 0)
                                        <span class="badge rounded-pill badge-secondary">Unpaid</span>
                                    @elseif ($order->status_payment == 1)
                                        <span class="badge rounded-pill badge-success">Paid</span>
                                    @elseif ($order->status_payment == 2)
                                        <span class="badge rounded-pill badge-danger">Payment is canceled</span>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            @if($order->status_payment != 2)
                @if($order->status_payment > 0)
                    <div class="card">
                        <div class="card-header">Tracking</div>
                        <div class="card-body">
                            @if($order->tracking == 5)
                                <div class="form-control bg-danger text-white">Order cancel by Customer</div>
                            @elseif($order->tracking == 3)
                                <div class=" text-success">
                                    Item received
                                </div>
                            @else
                                <form action="{{ route('order.update', $order->order_code) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <select onchange="this.form.submit()" name="trackingValue" class="form-select">
                                        <option value="0" {{ $order->tracking == 0 ? 'disabled selected' : '' }}>Order placed</option>
                                        <option value="1" {{ $order->tracking == 1 ? 'disabled selected' : '' }}>Preparing orders</option>
                                        @if ($order->carriers != null)
                                            <option value="2" {{ $order->tracking == 2 ? 'disabled selected' : '' }}>Out for delivery</option>
                                        @endif
                                        <option value="4" {{ $order->tracking == 4 ? 'disabled selected' : '' }}>Order canceled due to virtual user information</option>
                                    </select>
                                </form>

                            @endif
                        </div>
                    </div>
                @endif
                @if($order->status_payment == 0)
                    <div class="card">
                        <div class="card-header">Status Payment</div>
                        <div class="card-body">
                        <form action="{{ route('order.update.status.payment', $order->order_code) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status_payment" value="1">
                            <button class="btn btn-success">Paid</button>
                        </form>
                        </div>
                    </div>
                @endif
                @if($order->tracking != 5 && $order->tracking != 4 )

                    <div class="card">
                    <div class="card-header">Carriers</div>
                    <div class="card-body">
                        <form action="{{ route('order.update.carriers', $order->order_code) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                @if ($order->carriers == null)
                                    <input type="text" name="name" id="name" class="form-control">
                                @else
                                    <div class="form-control">
                                        {{ $order->carriers['name'] ? $order->carriers['name'] : '' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="bill_code" class="form-label">Bill of lading code</label>
                                @if ($order->carriers == null)
                                    <input type="text" name="billcode" id="bill_code"  class="form-control">
                                @else
                                    <div class="form-control">
                                        {{ $order->carriers['billcode'] ? $order->carriers['billcode'] : '' }}
                                    </div>
                                @endif
                            </div>
                            @if ($order->carriers == null)
                                <div class="form-group mb-3">
                                    <button type="submit" id="update-carries" class="btn btn-success">Save</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                @endif

            @endif


        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Total money</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Subtotal</th>
                                <th scope="col">{{ $order->getSubtotalFormatAttribute() }}</th>
                            </tr>
                            @if($order->promotion != null)
                                <tr>
                                    <th scope="col">Discount</th>
                                    <th scope="col"><del>{{ $order->getDiscountFormatAttribute() }}</del></th>
                                </tr>
                            @endif
                            <tr>
                                <th scope="col">Ship</th>
                                <th scope="col">{{ $order->getShippingFormatAttribute() }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Total</th>
                                <th scope="col">{{ $order->getTotalFormatAttribute() }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
