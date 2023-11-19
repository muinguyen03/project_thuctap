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
                            <label class="form-label">Author</label><br>
                            <input type="text" name="author" id="name" class="form-control " value="{{ old('name') }}">
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

