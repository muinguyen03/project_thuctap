<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin manager">
    <meta name="author" content="AdminManager">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @component('import.client.head')@endcomponent
    @yield('styles')
</head>
<body class="animsition">
    <div id="toastt"></div>
    @include('layouts.client.struct.header')
    @yield('content')
    @include('layouts.client.struct.footer')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    @component('import.client.body')@endcomponent
</body>
</html>
