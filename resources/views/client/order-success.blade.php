@extends('layouts.client.index')
@section('title', 'Order Status')
@section('styles')
@stop
@section('content')
    <div class="container m-5 mx-auto">
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
        <div class="d-flex align-items-center justify-content-center d-none">
            <div class="swal2-icon swal2-error swal2-animate-error-icon m-3" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
            <h1>Order Failed 😥</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mt-3 mb-5">
                        <h6 class="mb-3">Invoice</h6>
                        <div><b>#9128371823</b></div>
                        <div>Time: 11/07/2023 15:05:12</div>
                    </div>
                    <div class="col-sm-3 mt-3 mb-5">
                        <h6 class="mb-3">Shipment Details</h6>
                        <div>
                            <strong>Bob Mart</strong>
                        </div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Phone: +48 123 456 789</div>
                    </div>
                    <div class="col-sm-3 mt-3 mb-5">
                        <h6 class="mb-3">Payment</h6>
                        <div>
                            <strong>VNPAY PAYMENT</strong>
                        </div>
                        <div class="mt-2">
                            <span class="badge rounded-pill bg-secondary">Wait for pay</span>
                            <span class="badge rounded-pill bg-success">Payment success</span>
                            <span class="badge rounded-pill bg-danger">Payment canceled</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="center">Name</th>
                                <th class="center">Options</th>
                                <th class="right">Price</th>
                                <th class="center">Quantity</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="left">Extended License</td>
                                <td class="left">Size: XL <br> Color: Red</td>
                                <td class="right">$999,00</td>
                                <td class="center">1</td>
                                <td class="right">$999,00</td>
                            </tr>
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
                                <td class="right">$8.497,00</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Discount (20%)</strong>
                                </td>
                                <td class="right">$1,699,40</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>$7.477,36</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
