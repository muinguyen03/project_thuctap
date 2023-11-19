@extends('layouts.admin.index')
@section('title','Promotions')
@section('content')
    @component('admin.components.global.action')
        @slot('module')
            promotion
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form action="{{ route('promotion.store') }}" method="post" class="card flex-fill">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                        @if($errors->has('code'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('code') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Exprid</label>
                        <input type="date" name="exp" class="form-control" value="{{ old('exp') }}">
                        @if($errors->has('exp'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('exp') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" name="discount" class="form-control" value="{{ old('discount') }}">
                        @if($errors->has('discount'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('discount') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex">
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="status" value="0" checked> Mở
                            </div>
                            <div >
                                <input type="radio" id="name" class="form-check-input" name="status" value="1" > Đóng
                            </div>
                        </div>
                        @if($errors->has('status'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('status') }}
                            </div>
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
