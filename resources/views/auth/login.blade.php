@extends('layouts.client.index')
@section('title', 'Login')
@section('styles')
    <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
        }

        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>

@endsection
@section('content')
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Welcome to <br />
                        <span style="color: hsl(218, 81%, 75%)">Coza Store</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Login to your account or register new one to have full access to our website.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card">
                        <div class="card-body px-4 py-5 px-md-5">
                            <form action="{{route('auth.login.process')}}" method="POST" class="form" id="form-1">
                                @csrf

                                <div class="d-flex flex-row align-items-center justify-content-center">
                                    <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                    <button type="button" id="btn_login_google" class="btn btn-primary btn-floating mt-0 mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>
                                </div>

                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                                </div>

                                <!-- Email input -->
                                <div class="form-group mb-3">
                                    <div class="form-outline mb-1">
                                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter a valid email address" />
                                        <label class="form-label" for="email">Email address</label>
                                    </div>
                                    @if($errors->has('email'))
                                        <span class="text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                    <span class="form-message"></span>
                                </div>


                                <div class="form-group">
                                    <!-- Password input -->
                                    <div class="form-outline mb-1">
                                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter password" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    @if($errors->has('password'))
                                        <span class="text-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                    <span class="form-message"></span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">

                                    </div>
                                    <a href="{{route('auth.forgot')}}" class="text-body">Forgot password?</a>
                                </div>

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('auth.register')}}" class="link-danger">Register</a></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
@stop
@section('scripts')
    <script>
        loginValidate();

        document.querySelector('#btn_login_google').addEventListener('click', redirect_login_google);

        function redirect_login_google(){
            window.location.href = "{{route('auth.login_gg')}}";
        }

    </script>
@endsection
