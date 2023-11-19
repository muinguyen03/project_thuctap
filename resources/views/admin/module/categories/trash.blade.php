@extends('layouts.admin.index')
@section('title', 'Categories')
@section('content')
    @component('admin.components.global.index')
        @slot('module')
            category
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3 text-center">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name_category }}</td>
                                <td >
                                    @if($category->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($category->status == 1)
                                        <span class="badge bg-warning">Unactive</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    @component('admin.components.button.return')
                                        @slot('url')
                                            {{ route('category.restore', $category) }}
                                        @endslot
                                    @endcomponent
                                    &nbsp;
                                    @component('admin.components.button.trash')
                                        @slot('url')
                                            {{ route('category.force.delete', $category) }}
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
                    {{$categories->links()}}
                </ul>
            </div>
        </div>
    </div>
@stop
