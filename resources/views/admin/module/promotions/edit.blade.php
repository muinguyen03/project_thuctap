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
            <form action="{{ route('promotion.update', $promotion) }}" method="post" class="card flex-fill">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ $promotion->code }}">
                        @if($errors->has('code'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('code') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Exprid</label>
                        <input type="date" name="exp" class="form-control" value="{{ $promotion->exp  }}">
                        @if($errors->has('exp'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('exp') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" name="discount" class="form-control" value="{{ $promotion->discount  }}">
                        @if($errors->has('discount'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('discount') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        @foreach($arrProStatus as $option => $value)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status{{ $value }}" value="{{ $value }}" {{ $promotion->status == $value ? 'checked' : '' }}>
                                <label class="form-check-label " for="status{{ $value }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                        @if($errors->has('status'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('status') }}
                            </div>
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
