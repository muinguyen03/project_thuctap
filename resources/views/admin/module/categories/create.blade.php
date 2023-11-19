@extends('layouts.admin.index')
@section('title', 'Categories Create')
@section('content')
    @component('admin.components.global.action')
        @slot('module')
            category
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form action="{{ route('category.store') }}" method="post" class="card flex-fill">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name Category</label>
                        <input type="text" name="name_category" class="form-control" value="{{ old('name_category') }}">
                        @if($errors->has('name_category'))
                            <span class="text-danger">
                                {{ $errors->first('name_category') }}
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        @component('admin.components.button.submit')
                            @slot('title')
                                Create
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
