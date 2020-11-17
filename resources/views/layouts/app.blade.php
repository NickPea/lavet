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

    @yield('head')

</head>

<body>

    @include('toast.template')

    <div id="app">

        @include('components.navbar')

        <main>
            @yield('main')
        </main>

    </div>


    <footer>
        <div class="row mt-5" style="height: 80vh">
            <div class="col">
                <hr>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>