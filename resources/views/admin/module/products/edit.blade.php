@extends('layouts.admin.index')
@section('title', 'Products Edit')
@section('styles')
    <style>
        .preview {
            width: 100%;
            height: auto;
            color: white;
            font-size: 22px;
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            cursor: pointer;
        }

        .preview i {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .preview-imgg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }
    </style>
    @stop
@section('content')
    <div class="d-flex justify-content-between mb-3">
        @component('admin.components.breadcrumb')
            @slot('title')
                Product Edit
            @endslot
        @endcomponent
        @component('admin.components.button.back')
            @slot('url')
                product
            @endslot
        @endcomponent
    </div>
    <form action="{{ route('product.update', $product) }}" method="post" id="form-1" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            @foreach($images as $key => $item)
                                <div class="col-2" >
                                    <label for="input-img-{{$item->id}}" class="preview preview-{{$item->id}}">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>Upload</span>
                                    </label>
                                    <input type="file" name="{{$item->id}}" hidden id="input-img-{{$item->id}}" accept=".jpg,.png,.jpeg" />
                                </div>
                                <script>
                                    let img{{$item->id}} = document.createElement('img')
                                    img{{$item->id}}.src = '{{$item->getImgProductAttribute()}}'
                                    img{{$item->id}}.className = 'preview-imgg'
                                    document.querySelector('.preview-{{$item->id}}').appendChild(img{{$item->id}})
                                    document.querySelector('#input-img-{{$item->id}}').addEventListener('change', (e) => {
                                        let file = e.target.files[0]
                                        if (!file) return
                                        img{{$item->id}}.src = URL.createObjectURL(file)
                                    })
                                </script>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Status</label><br>
                            @foreach($arrStatus as $option => $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status{{ $value }}" value="{{ $value }}" {{ $product->status == $value ? 'checked' : '' }} />
                                    <label class="form-check-label" for="status{{ $value }}">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name_product" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control " value="{{ $product->name }}">
                            @if ($errors->has('name'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('name_product') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="price_product" class="form-label">Đơn giá</label>
                            <input type="number" name="price" id="price" class="form-control" min="0" value="{{ $product->price }}">
                            @if ($errors->has('price'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $value => $items)
                                    <option {{ $items->id == $product->id_category ? 'selected' : '' }}  value="{{$items->id}}">{{$items->name_category}}</option>
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
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Size</label><br>
                            @foreach($arrSize as $key => $item)
                                <div class="form-check form-check-inline">
                                    @if(in_array($item, $product->size))
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
                            <label for="" class="form-label">Dimensions</label>
                            <input type="text" name="dimensions" class="form-control" placeholder="110 x 33 x 100 cm" value="{{ $product->dimensions }}">
                            @if ($errors->has('dimensions'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('dimensions') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Materials</label>
                            <input type="text" name="materials" class="form-control" placeholder="60% cotton" value="{{ $product->materials }}">
                            @if ($errors->has('materials'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('materials') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Weight</label>
                            <input type="text" name="weight" class="form-control" placeholder="0.6" value="{{ $product->weight }}">
                            @if ($errors->has('weights'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('weights') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Color</label><br>
                            <input type="text" class="form-control" placeholder="Gray|White|Black" value=" {{ implode('|', $product->color) }}" name="color">
                            @if ($errors->has('color'))
                                <div class="text-danger mb-3">
                                    {{ $errors->first('color') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @component('admin.components.button.submit')
                            @slot('title')
                                Update
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection('content')
