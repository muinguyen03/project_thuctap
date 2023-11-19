@extends('layouts.client.index')
@section('title', 'Register')
@section('styles')
    <style>
        .panel-heading {
            text-align: center;
            margin-bottom: 10px
        }

        #forgot {
            min-width: 100px;
            margin-left: auto;
            text-decoration: none
        }

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

        .panel {
            min-height: 380px;
            box-shadow: 20px 20px 80px rgb(218, 218, 218);
            border-radius: 12px
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ddd;
            color: #4343ff
        }

        input[type='text'],
        input[type='password'] {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none
        }

        #google_png {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            position: relative
        }

        a[target='_blank'] {
            position: relative;
            transition: all 0.1s ease-in-out
        }

        .bordert {
            border-top: 1px solid #aaa;
            position: relative
        }

        .bordert:after {
            content: "or";
            position: absolute;
            top: -13px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 0px 8px
        }

        @media(max-width: 360px) {
            #forgot {
                margin-left: 0;
                padding-top: 10px
            }

            .bordert:after {
                left: 25%
            }
        }
    </style>
@endsection
@section('content')
{{--    <div style="margin: 0px auto; padding: 50px 0px 50px 0px" class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">--}}
{{--        <div class="panel border bg-white">--}}
{{--            <div class="panel-heading">--}}
{{--                <h3 class="pt-3 font-weight-bold">Register</h3>--}}
{{--            </div>--}}
{{--            <div class="panel-body p-3">--}}
{{--                <form action="{{route('auth.register.process')}}" method="POST" class="form" id="register-form">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="text" id="name" class="form-control" name="name" placeholder="Full name">--}}
{{--                        </div>--}}
{{--                        @if($errors->has('name'))--}}
{{--                            <span class="text-danger">--}}
{{--                                {{ $errors->first('name') }}--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                        <span class="form-message"></span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="text" id="email" class="form-control" name="email" placeholder="Email">--}}
{{--                        </div>--}}
{{--                        @if($errors->has('email'))--}}
{{--                            <span class="text-danger">--}}
{{--                                {{ $errors->first('email') }}--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                        <span class="form-message"></span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="password" id="password"  class="form-control" name="password" placeholder="Password">--}}
{{--                        </div>--}}
{{--                        @if($errors->has('password'))--}}
{{--                            <span class="text-danger">--}}
{{--                                {{ $errors->first('password') }}--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                        <span class="form-message"></span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="password" id="password_confirmation" class="form-control" name="confirm-password" placeholder="Confirm Password">--}}
{{--                        </div>--}}
{{--                        <span class="form-message"></span>--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-primary btn-block">Register</button>--}}
{{--                    <div class="text-center pt-4 text-muted">Have an account? <a href="{{route('auth.login')}}">Sign in</a> </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="mx-3 my-2 py-2 bordert d-flex justify-content-center align-items-center">--}}
{{--                <a href="{{route('auth.login_gg')}}" class="px-2">--}}
{{--                    <div class="border mt-3 p-2 rounded">--}}
{{--                        <img id="google_png" src="{{asset('assets/client/images/Google__G__Logo.svg.png')}}" alt="">--}}
{{--                        Sign up with Google--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form action="{{route('auth.register.process')}}" method="POST" id="register-form" class="form mx-1 mx-md-4">

                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-group w-100">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" name="name" id="name" class="form-control" />
                                                    <label class="form-label" for="name">Your Name</label>
                                                </div>
                                                @if($errors->has('name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @endif
                                                <span class="form-message"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-group w-100">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="email" name="email" id="email" class="form-control" />
                                                    <label class="form-label" for="email">Your Email</label>
                                                </div>
                                                @if($errors->has('email'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                                <span class="form-message"></span>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-group w-100">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" name="password" id="password" class="form-control" />
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                                @if($errors->has('password'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('password') }}
                                                    </span>
                                                @endif
                                                <span class="form-message"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-group w-100">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                                    <label class="form-label" for="password_confirmation">Repeat your password</label>
                                                </div>
                                                @if($errors->has('password_confirmation'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </span>
                                                @endif
                                                <span class="form-message"></span>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                        <div class="mx-3 my-2 py-2 mt-5 bordert d-flex justify-content-center align-items-center">
                                            <a href="{{route('auth.login_gg')}}" class="px-2 mt-3">
                                                <div class="border mt-3 p-2 rounded">
                                                    <img id="google_png" src="{{asset('assets/client/images/Google__G__Logo.svg.png')}}" alt="">
                                                    &nbsp;Sign up with Google
                                                </div>
                                            </a>
                                        </div>
                                        <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{route('auth.login')}}" class="fw-bold text-body"><u>Login here</u></a></p>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                         class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('scripts')
    <script>
        registerValidate();
    </script>
@endsection
