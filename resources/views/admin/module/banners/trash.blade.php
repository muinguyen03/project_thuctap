@extends('layouts.admin.index')
@section('title', 'Banner')

@section('content')
    @component('admin.components.global.index')
        @slot('module')
            banner
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3 text-center">
                    <thead>
                    <tr>
                        <th>Url</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($banner) > 0)
                        @foreach ($banner as $item)
                            <tr>
                                <td><img src="{{ $item->getImageBannerAttribute() }}" width="50px" height="50px" alt="Banner Image"></td>
                                <td >
                                    @if($item->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-warning">Unactive</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    @component('admin.components.button.return')
                                        @slot('url')
                                            {{ route('banner.restore', $item) }}
                                        @endslot
                                    @endcomponent
                                    &nbsp;
                                    @component('admin.components.button.trash')
                                        @slot('url')
                                            {{ route('banner.force.delete', $item) }}
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
                    {{ $banner->links() }}
                </ul>
            </div>
        </div>
    </div>
@stop
