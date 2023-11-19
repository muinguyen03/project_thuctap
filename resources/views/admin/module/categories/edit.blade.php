@extends('layouts.admin.index')
@section('title', 'Categories Edit')
@section('content')
    @component('admin.components.global.action')
        @slot('module')
            category
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form action="{{ route('category.update', $category)}}" method="post" class="card flex-fill">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Status</label><br>
                        @foreach($arrStatus as $option => $value)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status{{ $value }}" value="{{ $value }}" {{ $category->status == $value ? 'checked' : '' }} />
                                <label class="form-check-label" for="status{{ $value }}">{{ $option }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name Category</label>
                        <input type="text" name="name_category" class="form-control" value="{{$category->name_category}}">
                        @if($errors->has('name_category'))
                            <span class="text-danger">
                                {{ $errors->first('name_category') }}
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        @component('admin.components.button.submit')
                            @slot('title')
                                Update
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
