<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin manager">
    <meta name="author" content="AdminManager">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/icons/icon-48x48.png') }}"/>
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @yield('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="{{ asset('assets/css/toast.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/toast.js') }}"></script>
</head>
<body>
    <div id="toastt"></div>
    @yield('content')
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
