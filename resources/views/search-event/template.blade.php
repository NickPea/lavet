{{--  --}}



@extends('layouts.templates.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-event.styles.page')

<!-- Scripts -->
@include('search-event.scripts.intersection-observer')
@include('search-event.scripts.endpoints')
@include('search-event.scripts.hash-clear-on-reload')



@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')

@include('search-event.components.search-bar')

<div class="container">
    <!-- Components -->

    @include('search-event.components.top-bottom-buttons')
    
    
      
    
    <div class="row my-5">
        <div class="col">
            @include('search-event.components.results')
        </div>
        <div class="col-4">
            @include('search-event.components.index-navigation')
        </div>
    </div>
    
</div>


@endpush


{{-- -------------------------------------------------------------------------------- --}}