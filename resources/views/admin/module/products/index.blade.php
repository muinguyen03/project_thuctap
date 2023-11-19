@extends('layouts.admin.index')
@section('title', 'Products')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')
@component('admin.components.global.index')
@slot('module')
    product
@endslot
@endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3 text-center">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Price</th>
                        <th class="d-none d-xl-table-cell">Status</th>
                        <th class="d-none d-md-table-cell">Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($products) > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="{{ $product->getImgAttribute() }}" width="50px" height="50px" alt="User Image"></td>
                                <td>{{ $product->name }}</td>
                                <td class="d-none d-xl-table-cell">{{ $product->getMoneyFormatAttribute() }}</td>
                                <td class="d-none d-md-table-cell">
                                    @if($product->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($product->status == 1)
                                        <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $product->getCategoryProductAttribute() }}</td>
                                <td class="">
                                    @component('admin.components.button.edit')
                                        @slot('url')
                                            {{ route('product.edit', $product)}}
                                        @endslot
                                    @endcomponent
                                    <div class="mt-1 mb-1"></div>
                                    @component('admin.components.button.trash')
                                        @slot('url')
                                            {{ route('product.del', $product)}}
                                        @endslot
                                    @endcomponent
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="6">No data !</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
                <ul class="pagination">
                    {{$products->links()}}
                </ul>
            </div>
        </div>
    </div>
@stop


