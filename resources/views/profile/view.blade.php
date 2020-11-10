@extends('layouts.app')

@section('head')
<style>

</style>
@endsection

@section('title')
{{$profile->user->name}}
@endsection

@section('main')

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <!-- Squeezers----------------------------------->

            <div class="container py-5">


                <!-- row location -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        <!-- location -->
                        <div>
                            <h6>
                                @include('components.SVG-location')
                                <span class="text-muted font-weight-light">
                                    {{$profile->location->first()->city->name}},
                                    {{$profile->location->first()->province->name}},
                                    {{$profile->location->first()->country->name}},
                                    {{$profile->location->first()->area_code->name}},
                                </span>
                            </h6>
                        </div>

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
                                            <a href={{asset($profile->image->first()->path)}}><img class="w-100 rounded" src={{asset($profile->image->first()->path)}}
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

                        <!-- About me -->
                        <div>
                            <h5 class="font-weight-light" style="color:grey">Blurb</h5>
                            <p class="m-0">{{$profile->about}}</p>
                        </div>

                    </div> <!-- end col -->

                </div> <!-- end row-->

                <!-- row 2 -->
                <div class="row mt-4">


                    <!-- col -->
                    <!-- left panel -->
                    <div class="col-4" style="border-right:1px solid lightgrey">



                        <!-- inner row 1 -->
                        <div class="row py-3">
                            <div class="col">

                                <!-- Credentials -->
                                <div class="d-flex">
                                    <h5 class="font-weight-light" style="color:grey">Credentials
                                        ({{$profile->credential->count()}}) </h5>
                                    <small class="ml-auto"><a href="">See all</a></small>
                                </div>
                                @forelse ($profile->credential->take(2) as $credential)
                                <div class="row">
                                    <div class="col">

                                        <div class="card p-3 rounded-lg text-center d-flex flex-column justify-content-around"
                                            style="height:25vh;">
                                            <small class="text-muted">{{$credential->institution}}</small>
                                            <h5 class="card-title font-italic">{{$credential->name}}</h6>
                                                <h6 class="card-text">{{$credential->end_year}}</h6>
                                        </div>

                                    </div>
                                </div>
                                @empty
                                No Credentials...
                                @endforelse
                                <!-- end crednentials -->

                            </div> <!-- end col -->
                        </div> <!-- end inner row 1 -->


                        <!-- inner row 2 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <!-- col 1 -->
                            <div class="col">

                                <!-- Colleagues // People who you have given references too-->
                                <div class="d-flex">
                                    <h5 class="font-weight-light" style="color:grey">Colleagues
                                        ({{$profile->user->reference->map->profile->count()}})</h5>
                                    <small class="ml-auto"><a href="">See all</a></small>
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

                            </div> <!-- end col -->
                        </div> <!-- end inner row 2 -->


                        <!-- inner row 3 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <div class="col">

                                <div>
                                    <div class="d-flex">
                                        <h5 class="font-weight-light" style="color:grey">Hosted Events & Listings
                                            ({{$profile->user->event->count() + $profile->user->business->map->listing->count()}})
                                        </h5>
                                        <small class="ml-auto"><a href="">See all</a></small>
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
                                </div>

                            </div>
                        </div>



                        <!-- inner row 4-->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <div class="col">

                                <div>
                                    <div class="d-flex">
                                        <h5 class="font-weight-light" style="color:grey">Recent Activity
                                            ({{$profile->user->business->map->listing->count()}})</h5>
                                        <small class="ml-auto"><a href="">See all</a></small>
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
                                <div class="d-flex">
                                    <h5 class="font-weight-light" style="color:grey">Experience
                                        ({{$profile->experience->count()}})</h5>
                                    <small class="ml-auto"><a href="">See all</a></small>
                                </div>
                                @forelse ($profile->experience->take(3) as $experience)
                                <div class="card rounded-lg p-3">
                                    <div class="d-flex justify-content-between">
                                        <span>{{$experience->organisation}}</span>
                                        <span>{{$experience->work_role}}</span>
                                        <span>{{$experience->start_at->format('M-Y')}}</span>
                                        <span>{{$experience->end_at->format('M-Y')}}</span>
                                    </div>
                                </div>
                                @empty
                                <p>No experience recorded</p>
                                @endforelse
                                <!-- end experiences -->

                            </div> <!-- end col -->
                        </div> <!-- end inner row 1 -->



                        <!-- inner row 2 -->
                        <div class="row py-3" style="border-top:1px solid lightgrey">
                            <!-- inner col -->
                            <div class="col">


                                <!-- References -->
                                <div class="d-flex">
                                    <h5 class="font-weight-light" style="color:grey">References
                                        ({{$profile->reference->count()}})</h5>
                                    <small class="ml-auto"><a href="">See all</a></small>
                                </div>

                                <div>
                                    @forelse ($profile->reference->take(3) as $reference)
                                    <div class="rounded-lg mt-2 p-2" style="background-color: rgba(193, 206, 223, 0.3)">
                                        <q class="text-center font-weight-light font-italic">{{$reference->body}}</q>
                                        <div class="d-flex justify-content-end">
                                            <a class="text-reset text-decoration-none"
                                                href={{secure_url($reference->user->profile->path())}}>
                                                <div class="card rounded-lg">
                                                    <div class="d-flex align-items-center p-1">
                                                        <img class="rounded m-1" style="width:2rem"
                                                            src={{asset($reference->user->profile->image->first()->path)}}
                                                            alt="reference image">
                                                        <span
                                                            class="m-1 font-weight-bold">{{$reference->user->name}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @empty
                                    <p>No references... <a href="">add one!</a></p>
                                    @endforelse
                                </div> <!-- end references -->


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

@endsection