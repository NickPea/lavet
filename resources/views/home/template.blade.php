{{--  --}}


@extends('layouts.app-no-nav')

{{-- ----------------------------------------------------------------------------- --}}

@push('head')

    
@endpush

{{-- ----------------------------------------------------------------------------- --}}

@push('body')
    
@include('home.components.header')
@include('home.components.products')
@include('home.components.banner')
@include('home.components.sect3')
@include('home.components.footer')



@endpush