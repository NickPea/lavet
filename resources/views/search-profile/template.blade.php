{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-profile.styles.page')

<!-- Scripts -->
@include('search-profile.scripts.store')
@include('search-profile.scripts.reducers')
@include('search-profile.scripts.endpoints')
@include('search-profile.scripts.hydrate')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')


<!-- Components -->
@include('search-profile.components.search-bar')

@include('search-profile.components.search-results')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


