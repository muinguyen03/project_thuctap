@php
    $tab = $_GET['tab'] ?? null;
@endphp
@extends('layouts.client.index')
@section('title', 'Profile')
@section('styles')

@stop
@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30  p-b-30  p-lr-0-lg">
            <a href="{{route('client.home')}}" class="stext-109 cl8 hov-cl1 trans-04">Home<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i></a>
            <span class="stext-109 cl4">Profile</span>
        </div>
    </div>
    <section class="container mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link {{ ($tab === null) ? 'active' : '' }}" onclick="changeUrlWithoutReloading('/profile')" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="{{ ($tab === null || $tab === 'information') ? 'true' : 'false' }}">Information</a>

                <a class="nav-item nav-link {{ ($tab === 'change_pass') ? 'active' : '' }}" onclick="changeUrlWithoutReloading('/profile?tab=change_pass')" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="{{ ($tab === 'change_pass') ? 'true' : 'false' }}">Change Password</a>

                <a class="nav-item nav-link {{ ($tab === 'my_order') ? 'active' : '' }}" onclick="changeUrlWithoutReloading('/profile?tab=my_order')" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="{{ ($tab === 'my_order') ? 'true' : 'false' }}">Order History</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade {{ ($tab === null) ? 'show active' : '' }}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                @component('client.components.profile.information')
                @endcomponent
            </div>
            <div class="tab-pane fade {{ ($tab !== null && $tab === 'change_pass') ? 'show active' : '' }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @component('client.components.profile.changepass')
                @endcomponent
            </div>
            <div class="tab-pane fade {{ ($tab !== null && $tab === 'my_order') ? 'show active' : '' }}" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="container-xl px-4 mt-4">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive table-billing-history">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th class="border-gray-200" scope="col">Invoice ID</th>
                                        <th class="border-gray-200" scope="col">Order Date</th>
                                        <th class="border-gray-200" scope="col">Total</th>
                                        <th class="border-gray-200" scope="col">Status</th>
                                        <th class="border-gray-200" scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($order) > 0)
                                        @foreach($order as $item)
                                        <tr>
                                            <td>#{{$item->order_code}}</td>
                                            <td>{{$item->order_date}}</td>
                                            <td>{{$item->getTotalFormatAttribute() }}</td>
                                            <td>
                                                @if($item->status_payment == 1)
                                                    @if($item->tracking == 0)
                                                        <span class="badge rounded-pill badge-light">Order Processed</span>
                                                    @elseif($item->tracking == 1)
                                                        <span class="badge rounded-pill badge-light">Preparing orders</span>
                                                    @elseif($item->tracking == 2)
                                                        <span class="badge rounded-pill badge-light">Out for delivery</span>
                                                    @elseif($item->tracking == 3)
                                                        <span class="badge rounded-pill badge-success">Item received</span>
                                                    @endif
                                                @endif
                                                @if($item->status_payment == 0)
                                                    <span class="badge rounded-pill badge-warning">Wait Pay</span>
                                                @endif
                                                @if($item->status_payment == 2)
                                                    <span class="badge rounded-pill badge-danger">Pay Canceled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('client.order.detail', $item->order_code) }}" class="btn btn-sm btn-secondary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No order !</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

    </script>
@stop
