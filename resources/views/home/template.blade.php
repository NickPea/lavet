{{--  --}}


@extends('layouts.templates.app-no-nav')

{{-- ----------------------------------------------------------------------------- --}}

@push('head')

    
@endpush

{{-- ----------------------------------------------------------------------------- --}}

@push('body')
    
@include('home.components.header')
@include('home.components.products')
@include('home.components.banner')
@include('home.components.latest')
@include('home.components.quicklinks')



@endpush