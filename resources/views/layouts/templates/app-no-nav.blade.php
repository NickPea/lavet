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

    @include('layouts.scripts.state.chat-store')
    @include('layouts.scripts.state.chat-reducers')
    @include('layouts.scripts.endpoints')

    @stack('head')

</head>

<body>

    @include('layouts.components.toast')
    @include('layouts.components.sidechat')

    @stack('body')



    <!-- Bundled Script -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Websockets -->
    @include('layouts.scripts.socketio')

    @stack('scripts')

</body>

</html>