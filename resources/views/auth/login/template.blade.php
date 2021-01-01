

@extends('layouts.templates.app')


@push('head')
    
@endpush


@push('body')

<div class="d-flex justify-content-center align-items-center" style="height: 60vh">
    @include('auth.login.components.login-card')
</div>
    
@endpush