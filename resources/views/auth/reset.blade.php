@extends('layouts.client.index')
@section('title', 'Reset Password')
@section('styles')
    <style>
        a:hover {
            text-decoration: none
        }

        .form-inline label {
            padding-left: 10px;
            margin: 0;
            cursor: pointer
        }

        .btn.btn-primary {
            margin-top: 20px;
            border-radius: 15px
        }
        input[type='text'],
        input[type='password'] {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%
        }
        a[target='_blank'] {
            position: relative;
            transition: all 0.1s ease-in-out
        }
    </style>
@endsection
@section('content')
    <div style="margin: 0px auto; padding: 50px 0px 50px 0px" class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
        <div class="card" style="min-width: 300px;">
            <div class="card-header h5 text-white bg-primary">Password Reset</div>
            <div class="card-body px-5">
                <form action="{{route('auth.reset.process')}}" method="post" class="form" id="reset-password-form">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="form-group">
                        <div class="form-outline">
                            <input type="password" id="new_password" name="new_password" class="form-control my-3" />
                            <label class="form-label" for="new_password">New Password</label>
                        </div>
                        @if($errors->has('new_password'))
                            <span class="text-danger">
                                {{ $errors->first('new_password') }}
                            </span>
                        @endif
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-outline">
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control my-3" />
                            <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                        </div>
                        @if($errors->has('new_password_confirmation'))
                            <span class="text-danger">
                                {{ $errors->first('new_password_confirmation') }}
                            </span>
                        @endif
                        <span class="form-message"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset password</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        resetPasswordValidate();
    </script>
@endsection
