{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-listing.styles.page')

<!-- Scripts -->
@include('search-listing.scripts.store')
@include('search-listing.scripts.reducers')
@include('search-listing.scripts.endpoints')
@include('search-listing.scripts.hydrate')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')


<!-- Components -->
@include('search-listing.components.search-bar')

@include('search-listing.components.search-results')


@endpush


{{-- -------------------------------------------------------------------------------- --}}


