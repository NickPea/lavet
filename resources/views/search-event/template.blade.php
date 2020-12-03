{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-event.styles.page')

<!-- Scripts -->
@include('search-event.scripts.intersection-observer')



@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')


<div class="container">
    <!-- Components -->

    @include('search-event.components.scroll-top-scroll-bottom-buttons')
    
    <div class="row my-5">
        <div class="col">
            @include('search-event.components.search-bar')
        </div>
    </div>
    
    <div class="row my-5">
        <div class="col-4">
            @include('search-event.components.side-navigation')
        </div>
        <div class="col">
            @include('search-event.components.search-results')
        </div>
    </div>
    
</div>


@endpush


{{-- -------------------------------------------------------------------------------- --}}