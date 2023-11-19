@extends('layouts.admin.index')
@section('title', 'Orders')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        @component('admin.components.breadcrumb')
            @slot('title')
                Orders
            @endslot
        @endcomponent

    </div>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3">
                    <thead>
                    <tr>
                        <th>Order code</th>
                        <th class="d-none d-xl-table-cell">Order date</th>
                        <th>User Phone Number</th>
                        <th class="d-none d-xl-table-cell">Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($orders) > 0)
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->order_code }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->order_date }}</td>
                                    <td>{{ $item->user['phone'] }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->getTotalFormatAttribute() }}</td>
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
                                            @elseif($item->tracking == 4)
                                                <span class="badge rounded-pill badge-danger">Cancel by admin</span>
                                            @elseif($item->tracking == 5)
                                                <span class="badge rounded-pill badge-danger">Cancel by user</span>
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
                                        <a href="{{ route('order.show', $item->order_code) }}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="3">No data !</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <ul class="pagination">
                    {{-- {{$categories->links()}} --}}
                </ul>
            </div>
        </div>
    </div>
@stop
