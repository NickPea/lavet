@extends('layouts.app')


{{-- HEAD --}}
@push('head')

<!-- Page Styles -->
@include('profile.styles.page')

<!-- State Management -->
@include('profile.scripts.state.store')
@include('profile.scripts.state.reducers')

<!-- title -->
<title>
    {{$profile->user->name.' | '.config('app.name', 'ERROR')}}
</title>

@endpush


{{-- BODY --}}
@push('body')


<!-- Modals -->
@include('profile.components.profile-image-modal')
@include('profile.components.edit-profile-modal')


<div class="container py-5">


    <div class="row mb-5">
        <div class="col">

            <!-- Header -->
            @include('profile.components.header')

        </div><!-- //col -->
    </div>


    <!-- squeezers -->
    <div class="row">
        <div class="col-8">


            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    @include('profile.components.about')

                </div>
            </div><!-- //inner row -->


            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    @include('profile.components.experience')

                </div>
            </div> <!-- //inner row -->


            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    @include('profile.components.reference')

                </div>
            </div> <!-- //inner row -->


            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    @include('profile.components.colleague')

                </div>
            </div>


            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    @include('profile.components.credential')

                </div>
            </div> <!-- //inner row -->


        </div><!-- //col -->

        <div class="col-4">

            <!-- inner row -->
            <div class="row mb-3">
                <div class="col">

                    {{-- @include('profile.components.button-bar') --}}

                </div>
            </div><!-- //inner row -->

        </div><!-- //col -->
    </div><!-- //row -->


</div> <!-- end container -->


<!-- Endpoints -->
@include('profile.scripts.endpoints')
<!-- Hydrate store on initial load -->
@include('profile.scripts.hydrate')

@endpush