@extends('layouts.admin.index')
@section('title', 'User Create')

@section('content')
    @component('admin.components.global.action')
        @slot('module')
            users
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <form class="card flex-fill" action="{{ route('users.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Role</label>
                        <div class="d-flex">
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="role" value="0"> Admin
                            </div>
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="role" value="1" > Nhân viên
                            </div>
                            <div>
                                <input type="radio" id="name" class="form-check-input" name="role" value="2" > Người dùng
                            </div>
                        </div>
                        @if ($errors->has('role'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('role') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Họ và Tên</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                         @if ($errors->has('name'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" name="email" id="name" class="form-control" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input type="password" name="pass" id="name" class="form-control" value="{{ old('pass') }}">
                        @if ($errors->has('pass'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('pass') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Số điện thoại</label>
                        <input type="number" name="phone" id="name" class="form-control " value="{{ old('phone') }}">
                        @if ($errors->has('phone'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Địa chỉ</label>
                        <input type="text" name="address" id="name" class="form-control " value="{{ old('address') }}">
                        @if ($errors->has('address'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Status</label>
                        <div class="d-flex">
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="status" value="0"> Mở
                            </div>
                            <div class="me-5">
                                <input type="radio" id="name" class="form-check-input" name="status" value="1" > Đóng
                            </div>
                            <div>
                                <input type="radio" id="name" class="form-check-input" name="status" value="2" > Chờ Duyệt
                            </div>
                        </div>
                        @if ($errors->has('status'))
                            <div class="text-danger mb-3">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-5 mx-auto" style="width: 15%; height: 200px">
                                    <img class="d-block rounded" id="imgPreview" src="https://flxtable.com/wp-content/plugins/pl-platform/engine/ui/images/image-preview.png" alt="pic" width="100%" height="100%" />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" name="image" id="image" accept=".jpg,.png,.jpeg" class="form-control" value="{{ old('image') }}" >
                                    @if ($errors->has('image'))
                                        <div class="text-danger mb-3">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    <div class="mt-5">
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
@endsection('content')
