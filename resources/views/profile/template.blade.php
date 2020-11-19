@extends('layouts.app')


{{-- HEAD --}}
@push('head')

<title>
    {{$profile->user->name.' | '.config('app.name', 'ERROR')}}
</title>

<!-- Page Styles -->
@include('profile.styles.page')

<!-- State Management -->
@include('profile.scripts.state-store')
@include('profile.scripts.state-reducers')

@endpush
{{-- //HEAD --}}

{{-- BODY --}}
@push('body')

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <!-- Squeezers----------------------------------->

            <div class="container py-5">

                <!-- row 1 -->
                <div class="row no-gutters py-4" style="border-bottom: 1px solid lightgrey">
                    <div class="col">
                        
                        <!-- innner row -->
                        <div class="row pb-3">
                            <div class="col-8">

                                <!-- Header -->
                                @include('profile.components.header')

                            </div>
                        </div>

                        <!-- innner row -->
                        <div class="row">
                            <div class="col-8">

                                <!-- Location -->
                                @include('profile.components.location')

                            </div>
                        </div>


                    </div><!-- //col -->
                </div><!-- //row 1 -->


                <!-- row 2 -->
                <div class="row py-4">
                    <!-- LEFT COL -->
                    <div class="col-4">

                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.colleague')

                            </div>
                        </div>

                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.event')

                            </div>
                        </div><!-- //inner row -->

                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.listing')

                            </div>
                        </div><!-- //inner row -->


                    </div>
                    <!-- //LEFT COL -->


                    <!-- col -->
                    <!-- RIGHT COL -->
                    <div class="col-8">


                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.about')

                            </div>
                        </div><!-- //inner row -->


                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.credential')

                            </div>
                        </div> <!-- //inner row -->


                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.experience')

                            </div>
                        </div> <!-- //inner row -->


                        <!-- inner row -->
                        <div class="row pb-3">
                            <div class="col">

                                @include('profile.components.reference')

                            </div>
                        </div> <!-- //inner row -->


                    </div> <!-- //col -->
                    <!-- //RIGHT COL -->


                </div> <!-- //row 2-->


            </div> <!-- end container -->


            <!-- end Squeezers----------------------------------->
        </div>
    </div>
</div>

@endpush
{{-- //BODY --}}