@extends('layouts.app')


{{-- HEAD --}}
@push('head')

<title>
    {{$profile->user->name.' - '.config('', 'ERROR')}}
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
                <div class="row mt-2">

                    <div class="col-8">

                        <!-- Header-Card -->
                        @include('profile.components.header-card')

                        <!-- Location -->
                        @include('profile.components.location')

                    </div>

                    <div class="col-4">

                        <!-- About -->
                        @include('profile.components.about')

                    </div>

                </div> 

                <!-- row 2 -->
                <div class="row mt-4">


                    <!-- col -->
                    <!-- left panel -->
                    <div class="col-4" style="border-right:1px solid lightgrey">



                        <!-- inner row 1 -->
                        <div class="row py-3">
                            <div class="col">

                                @include('profile.components.credential')

                            </div> <!-- end col -->
                        </div> <!-- end inner row 1 -->


                        <!-- inner row 2 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <!-- col 1 -->
                            <div class="col">

                                <!-- Colleagues // People who you have given references too-->
                                <div class="content-wrapper">
                                    <div class="d-flex">
                                        <h5 class="font-weight-light" style="color:grey">Colleagues
                                            ({{$profile->user->reference->map->profile->count()}})</h5>
                                        <!-- options-dropdown -->
                                        <div class="btn-group ml-auto">
                                            <a href="#" class="options-button" data-toggle="dropdown">
                                                @include('svg.more')
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item font-weight-bold">Action</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                @forelse ($profile->user->reference->map->profile->take(4) as $profile)
                                                <div class="col-6">

                                                    <div>
                                                        <a href={{secure_url($profile->path())}}>
                                                            <img class="img-thumbnail"
                                                                src={{url($profile->image->first()->path)}}
                                                                alt="Colleague Image">
                                                        </a>
                                                        <a class="text-reset" href={{secure_url($profile->path())}}>
                                                            <b>{{$profile->user->name}}</b>
                                                        </a>
                                                    </div>

                                                </div>
                                                @empty
                                                No Colleagues
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end col -->
                        </div> <!-- end inner row 2 -->


                        <!-- inner row 3 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <div class="col">

                                <div class="content-wrapper">
                                    <div class="d-flex">
                                        <h5 class="font-weight-light" style="color:grey">Events & Listings
                                            ({{$profile->user->event->count() + $profile->user->business->map->listing->count()}})
                                        </h5>
                                        <!-- options-dropdown -->
                                        <div class="btn-group ml-auto">
                                            <a href="#" class="options-button" data-toggle="dropdown">
                                                @include('svg.more')
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item font-weight-bold">Action</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="row">
                                                @forelse($profile->user->event->concat($profile->user->business->map->listing)->flatten()->shuffle()
                                                as $hosted)
                                                <div class="col-6">
                                                    <a href={{secure_url($hosted->path())}}>
                                                        <img class="img-thumbnail"
                                                            src={{url($hosted->image->first()->path)}}
                                                            alt="Colleague Image">
                                                    </a>
                                                    <a class="text-reset" href={{secure_url($hosted->path())}}>
                                                        <b>{{$hosted->title}}</b>
                                                    </a>
                                                </div>
                                                @empty

                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- //content-wrapper -->

                            </div>
                        </div>



                        <!-- inner row 4-->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <div class="col">

                                <div class="content-wrapper">
                                    <div class="d-flex">
                                        <h5 class="font-weight-light" style="color:grey">Recent Activity
                                            ({{$profile->user->business->map->listing->count()}})</h5>
                                        <!-- options-dropdown -->
                                        <div class="btn-group ml-auto">
                                            <a href="#" class="options-button" data-toggle="dropdown">
                                                @include('svg.more')
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item font-weight-bold">Action</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div> <!-- end col -->
                    <!-- end left panel -->


                    <!-- col -->
                    <!-- right panel -->
                    <div class="col-8">


                        <!-- inner row 1 -->
                        <div class="row py-3">
                            <!-- col -->
                            <div class="col">

                                <!-- Experience -->
                                @include('profile.components.experience')
                                <!-- end experiences -->

                            </div> <!-- end col -->
                        </div> <!-- end inner row 1 -->



                        <!-- inner row 2 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <!-- inner col -->
                            <div class="col">

                                <!-- References -->
                                @include('profile.components.reference')

                            </div> <!-- end col -->
                        </div> <!-- end innner row 2 -->


                    </div> <!-- end col -->
                    <!-- end right panel -->


                </div> <!-- end row 2-->


            </div> <!-- end container -->


            <!-- end Squeezers----------------------------------->
        </div>
    </div>
</div>

@endpush
{{-- //BODY --}}