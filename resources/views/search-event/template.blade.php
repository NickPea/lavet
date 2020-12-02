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


<div class="container">

    <!-- Components -->

    @include('search-event.components.back-to-top-button')
    
    <div class="row my-5">
        <div class="col">
            @include('search-event.components.search-bar')
        </div>
    </div>

    <div class="row my-5">
        <div class="col">
            @include('search-event.components.search-results')
        </div>
        <div class="col-4">
            @include('search-event.components.side-navigation')
        </div>
    </div>

</div>


@endpush


{{-- -------------------------------------------------------------------------------- --}}