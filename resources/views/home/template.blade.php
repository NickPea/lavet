{{--  --}}


@extends('layouts.app-no-nav')

{{-- ----------------------------------------------------------------------------- --}}

@push('head')

    
@endpush

{{-- ----------------------------------------------------------------------------- --}}

@push('body')
    
@include('home.components.header')
@include('home.components.products')



@endpush