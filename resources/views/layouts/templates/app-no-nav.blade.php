<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bunndled Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- App Styles -->
    @include('layouts.styles.page')

    @stack('head')

</head>

<body>

    @include('layouts.components.toast')

    @stack('body')



    <!-- Bundled Script -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>