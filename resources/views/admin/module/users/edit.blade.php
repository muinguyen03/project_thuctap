@extends('layouts.admin.index')
@section('title', 'Users Edit')
@section('content')
    @component('admin.components.global.action')
        @slot('module')
            users
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form class="card flex-fill" action="{{ route('users.update', $user) }}" method="post" id="form-1" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Role</label>
                        <div class="d-flex">
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="role" value="0" {{ $user->role == 0 ? "checked" : ""}}> Admin
                            </div>
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="role" value="1" {{ $user->role == 1 ? "checked" : ""}}> Nhân viên
                            </div>
                            <div>
                                <input type="radio" id="name" class="form-check-input" name="role" value="2" {{ $user->role == 2 ? "checked" : ""}}> Người dùng
                            </div>
                        </div>
                        @if ($errors->has('role'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('role') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name_product" class="form-label">Họ và Tên</label>
                        <input type="text" name="name" id="name" class="form-control " value="{{ $user->name }}">
                        @if ($errors->has('name'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name_product" class="form-label">Email</label>
                        <input type="text" name="email" id="name" class="form-control " value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name_product" class="form-label">Số điện thoại</label>
                        <input type="number" name="phone" id="name" class="form-control " value="{{ $user->phone }}">
                        @if ($errors->has('phone'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name_product" class="form-label">Địa chỉ</label>
                        <input type="text" name="address" id="name" class="form-control " value="{{ $user->address }}">
                        @if ($errors->has('address'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Status</label>
                       @foreach($arrUserStatus as $option => $value)
                           <div class="form-check">
                               <input class="form-check-input" type="radio" name="status" id="status{{ $value }}" value="{{ $value }}" {{ $user->status == $value ? 'checked' : '' }}>
                               <label class="form-check-label" for="status{{ $value }}">
                                   {{ $option }}
                               </label>
                           </div>
                       @endforeach
                        @if ($errors->has('status'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-5 mx-auto" style="width: 15%; height: 200px">
                                <img class="d-block rounded" id="imgPreview" src="{{ $user->image }}" alt="pic" width="100%" height="100%" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Avatar</label>
                                <input type="file" name="image" id="image"  class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        @component('admin.components.button.submit')
                            @slot('title')
                                Update
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            $(document).ready(() => {
                $("#image").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) { $("#imgPreview").attr("src", event.target.result); };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
@endsection
