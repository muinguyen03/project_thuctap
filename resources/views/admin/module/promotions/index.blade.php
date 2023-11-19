@extends('layouts.admin.index')
@section('title','Promotions')
@section('content')
    @component('admin.components.global.index')
        @slot('module')
            promotion
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3 text-center">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Exprid</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($promotions) > 0)
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ $promotion->exp }}</td>
                                <td>{{ $promotion->getDiscountFormatAttribute() }}</td>
                                <td >
                                    @if($promotion->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($promotion->status == 1)
                                        <span class="badge bg-warning">Unactive</span>
                                    @endif
                                </td>
                                <td>
                                    @component('admin.components.button.edit')
                                        @slot('url')
                                            {{ route('promotion.edit', $promotion)}}
                                        @endslot
                                    @endcomponent
                                    <div class="mt-1 mb-1"></div>
                                    @component('admin.components.button.trash')
                                        @slot('url')
                                            {{ route('promotion.del', $promotion)}}
                                        @endslot
                                    @endcomponent
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
                    {{$promotions->links()}}
                </ul>
            </div>
        </div>
    </div>
@stop
