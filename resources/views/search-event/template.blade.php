{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-event.styles.page')

<!-- Scripts -->
@include('search-event.scripts.store')
@include('search-event.scripts.reducers')
@include('search-event.scripts.endpoints')
@include('search-event.scripts.hydrate')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')


<!-- Components -->
@include('search-event.components.search-bar')

@include('search-event.components.search-results')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


