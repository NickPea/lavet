{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search.styles.page')

<!-- Scripts -->
@include('search.scripts.store')
@include('search.scripts.reducers')
@include('search.scripts.endpoints')
@include('search.scripts.hydrate')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')


<!-- Components -->
@include('search.components.search-bar')

@include('search.components.search-results')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


