{{--  --}}



@extends('layouts.app')



{{-- -------------------------------------------------------------------------------- --}}


@push('head')


<!-- Title -->
<title>{{config('app.name', 'ERROR')}} : Build your veteinary network</title>

<!-- Styles -->
@include('search-profile.styles.page')

<!-- Scripts -->
@include('search-profile.scripts.intersection-observer')
@include('search-profile.scripts.endpoints')
@include('search-profile.scripts.hash-clear-on-reload')



@endpush


{{-- -------------------------------------------------------------------------------- --}}


@push('body')

@include('search-profile.components.search-bar')

<div class="container">
    <!-- Components -->

    @include('search-profile.components.top-bottom-buttons')
    
    
      
    
    <div class="row my-5">
        <div class="col">
            @include('search-profile.components.results')
        </div>
        <div class="col-4">
            @include('search-profile.components.index-navigation')
        </div>
    </div>
    
</div>


@endpush


{{-- -------------------------------------------------------------------------------- --}}