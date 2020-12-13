{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-listing.styles.page')

<!-- Scripts -->
@include('search-listing.scripts.intersection-observer')
@include('search-listing.scripts.endpoints')
@include('search-listing.scripts.hash-clear-on-reload')



@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')

@include('search-listing.components.search-bar')

<div class="container">
    <!-- Components -->

    @include('search-listing.components.top-bottom-buttons')
    
    
      
    
    <div class="row my-5">
        <div class="col">
            @include('search-listing.components.results')
        </div>
        <div class="col-4">
            @include('search-listing.components.index-navigation')
        </div>
    </div>
    
</div>


@endpush


{{-- -------------------------------------------------------------------------------- --}}