@extends('layouts.client.index')
@section('title', 'Forgot Password')
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
                <p class="card-text py-2">
                    Enter your email address and we'll send you an email with instructions to reset your password.
                </p>
                <form action="{{route('auth.forgot.process')}}" method="post" class="form" id="forgot-form">
                    @csrf
                    <div class="form-group">
                        <div class="form-outline">
                            <input type="email" id="email" name="email" class="form-control my-3" />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                        <span class="form-message"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    <div class="d-flex justify-content-between mt-4">
                        <a class="" href="{{route('auth.login')}}">Login</a>
                        <a class="" href="{{route('auth.register')}}">Register</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
@section('scripts')
    <script>
        forgotPasswordValidate();
    </script>
@endsection
