<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{ asset('assets/client/images/icons/favicon.png') }} "/>
<link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
<!--===============================================================================================-->
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/bootstrap/css/bootstrap.min.css') }}">--}}
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/slick/slick.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/MagnificPopup/magnific-popup.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/main.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

<link href="{{ asset('assets/css/toast.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/toast.js') }}"></script>
<link href="{{ asset('assets/client/css/home.css') }}" rel="stylesheet">
<link href="{{ asset('assets/client/css/checkout.css') }}" rel="stylesheet">
<script src="{{ asset('modules/validate.js') }}"></script>
@if(Auth::check())
    <script src="{{ asset('assets/js/validate/profile.js') }}"></script>
@else
    <script src="{{ asset('assets/js/validate/auth.js') }}"></script>
@endif


<style>
    a {
        text-decoration: none;
    }
    .form-group.invalid .form-control {
        border-color: #f33a58;
    }

    .form-group.invalid .form-message {
        color: #f33a58;
    }

    .input-field {
       margin-bottom: 5px;
    }
</style>

<script>
    function changeUrlWithoutReloading(url) {
        window.history.pushState("", "", url);
    }
</script>
