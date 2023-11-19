@extends('layouts.admin.index')
@section('title', 'Products Create')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        @component('admin.components.breadcrumb')
            @slot('title')
                Product Create
            @endslot
        @endcomponent
        @component('admin.components.button.back')
            @slot('url')
                product
            @endslot
        @endcomponent
    </div>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control " value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" min="0" value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $value => $items)
                                    <option {{ $items->id == old('category_id') ? 'selected' : '' }}  value="{{$items->id}}">{{$items->name_category}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn">
                                        <p>Upload images</p>
                                        <input type="file" name="images[]" multiple accept="image/jpg, image/png, image/gif, image/jpeg" class="upload__inputfile">
                                    </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>
                            @if ($errors->has('images'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('images') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Size</label><br>
{{--                            @foreach($arrSize as $key => $item)--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input class="form-check-input" name="size[]" type="checkbox" id="{{ $item }}" value="{{$item}}" />--}}
{{--                                    <label class="form-check-label" for="{{ $item }}">{{ $item }}</label>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
                            @foreach($arrSize as $key => $item)
                                <div class="form-check form-check-inline">
                                    @if(in_array($item, old('size', [])))
                                        <input class="form-check-input" name="size[]" type="checkbox" id="{{ $item }}" value="{{ $item }}" checked />
                                    @else
                                        <input class="form-check-input" name="size[]" type="checkbox" id="{{ $item }}" value="{{ $item }}" />
                                    @endif
                                    <label class="form-check-label" for="{{ $item }}">{{ $item }}</label>
                                </div>
                            @endforeach
                            @if ($errors->has('size'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('size') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Color</label><br>
                            <input type="text" class="form-control" placeholder="Gray|White|Black" name="color" value="{{ old('color') }}">
                            @if ($errors->has('color'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('color') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Dimensions</label>
                                <input type="text" name="dimensions" class="form-control" placeholder="110 x 33 x 100 cm" value="{{ old('dimensions') }}">
                                @if ($errors->has('dimensions'))
                                    <div class="text-danger mb-3">
                                        {{ $errors->first('dimensions') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Materials</label>
                                <input type="text" name="materials" class="form-control" placeholder="60% cotton" value="{{ old('materials') }}">
                                @if ($errors->has('materials'))
                                    <div class="text-danger mb-3">
                                        {{ $errors->first('materials') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Weight</label>
                                <input type="text" name="weight" class="form-control" placeholder="0.6" value="{{ old('weight') }}">
                                @if ($errors->has('weight'))
                                    <div class="text-danger mb-3">
                                        {{ $errors->first('weight') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        @component('admin.components.button.submit')
                            @slot('title')
                                Create
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>

    </script>
@endsection('content')
<div class="card">--}}

