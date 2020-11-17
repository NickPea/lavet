<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('head')

</head>

<body>

    @include('layouts.toast')

    @include('layouts.navbar')

    @stack('body')

    <footer>
        <div class="row mt-5" style="height: 80vh">
            <div class="col">
                <hr>
            </div>
        </div>
    </footer>



    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>