@extends('layouts.admin.index')
@section('title', 'Categories Edit')
@section('styles')
    <style>

        .preview {
            width: 100%;
            height: 350px;
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

        .img-preview {
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
    @component('admin.components.global.action')
        @slot('module')
            banner
        @endslot
    @endcomponent
    <form class="row" action="{{ route('banner.update', $banner)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Status</label><br>
                        @foreach($arrStatus as $option => $value)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status{{ $value }}" value="{{ $value }}" {{ $banner->status == $value ? 'checked' : '' }} />
                                <label class="form-check-label" for="status{{ $value }}">{{ $option }}</label>
                            </div>
                        @endforeach
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
        <div class="col-4">
            <div class="container">
                <label for="input-img" class="preview">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Upload to preview image</span>
                </label>
                <input type="file" name="image_banner" hidden id="input-img" />
                <div id="cancel_button" class="mt-2"></div>
            </div>

        </div>
    </form>
@stop
@section('scripts')
    <script>
        const inputImg = document.querySelector('#input-img')
        let img = document.createElement('img')
        img.src = '{{$banner->getImageBannerAttribute()}}'
        function checkSrc(img) {
            let check = new RegExp('{{$banner->getImageBannerAttribute()}}').test(img.src);
            if(!check){
                document.querySelector('#cancel_button').innerHTML = `<button class="btn btn-secondary" id="cancel_img">The original image</button>`
                document.querySelector('#cancel_img').addEventListener('click', (e) => {
                    img.src = '{{$banner->getImageBannerAttribute()}}'
                    $('#cancel_button').html('');
                })
            }
        }
        checkSrc(img)
        img.className = 'img-preview'
        document.querySelector('.preview').appendChild(img)
        inputImg.addEventListener('change', (e) => {
            let file = e.target.files[0]
            if (!file) return
            img.src = URL.createObjectURL(file)
            checkSrc(img)
        })
    </script>
@stop
