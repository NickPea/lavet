@extends('layouts.app')

@section('title')
{{$profile->user->name}}
@endsection

{{-- HEAD --}}
@push('head')

<!-- Page Styles -->
<style>
    .content-wrapper {
        /* box-shadow: 1px 1px 1rem darksalmon; */
        background: rgb(230, 230, 230);
        border-radius: 1rem;
        padding: 1rem;
        transition: 100ms;
    }

    .content-wrapper:hover {
        background: rgb(240, 240, 240);
        /* box-shadow: 1px 1px 10px grey; */
    }

    .options-button {
        padding: 0.2rem;
        border-radius: 50%;
        transition: 250ms;
    }

    .options-button:hover {
        background: white;

    }
</style>

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


                <!-- row location -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        @include('profile.components.location')

                    </div> <!-- end col 1 -->
                </div> <!-- end row location -->


                <!-- row 1 -->
                <div class="row mt-2">
                    <!-- left panel -->
                    <div class="col-8">

                        <!-- Card -->
                        <div class="card p-2 rounded-lg shadow-lg">

                            <!-- Card Body-->
                            <div class="card-body">

                                <!-- inner row -->
                                <div class="row">
                                    <!-- inner col 1-->
                                    <div class="col-5">

                                        <!-- overlay wrapper -->
                                        <div class="position-relative">
                                            <!-- image -->
                                            <a href={{asset($profile->image->first()->path)}}><img class="w-100 rounded"
                                                    src={{asset($profile->image->first()->path)}}
                                                    alt="profile image"></a>

                                            <!-- image overlay -->
                                            <div class="position-absolute" style="top:-5%; left:-5%">

                                                <!-- is_free -->
                                                <h5>
                                                    @if ($profile->is_free===1)
                                                    <span class="badge badge-success border py-2">
                                                        Online
                                                    </span>
                                                    @else
                                                    <span class="badge badge-secondary border py-2">
                                                        Offline
                                                    </span>
                                                    @endif
                                                </h5>

                                            </div>
                                            <!-- end image overlay -->
                                        </div>
                                        <!-- end overlay wrapper -->

                                    </div>
                                    <!-- end inner col 1 -->

                                    <!-- inner col 2 -->
                                    <div class="col">

                                        <!-- name, field & position -->
                                        <div class="h-100 d-flex flex-column">
                                            <h3 class="font-weight-bold">
                                                {{$profile->user->name}}
                                            </h3>
                                            <div class="mt-auto">
                                                <h6 class="text-muted font-weight-lighter">
                                                    {{$profile->field->implode('name', ', ')}}
                                                </h6>
                                                <h5 class="text-secondary">
                                                    {{$profile->position->implode('name', ', ')}}
                                                </h5>
                                            </div>
                                        </div>

                                    </div><!-- end inner col 2 -->
                                </div> <!-- inner row -->

                                <div class="row mt-4">
                                    <div class="col">
                                        <h5 class="m-0"><i>"{{$profile->work_status}}"</i></h5>
                                    </div>
                                </div>

                            </div> <!-- end card body -->

                        </div> <!-- end card -->

                    </div> <!-- end col 1 -->

                    <!-- col-->
                    <div class="col-4">

                        <!-- About -->
                        @include('profile.components.about')                        

                    </div>

                </div> <!-- end row-->

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
