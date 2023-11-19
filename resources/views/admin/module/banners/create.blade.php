@extends('layouts.admin.index')
@section('title', 'Banner Create')
@section('content')

    @component('admin.components.global.action')
        @slot('module')
            banner
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form action="{{ route('banner.store') }}" method="post" class="card flex-fill" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <p>Upload images</p>
                                    <input type="file" name="image_banner[]" multiple max="3" class="upload__inputfile">
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>
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
    <script>

    </script>
@stop
