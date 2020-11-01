@extends('layouts.app')

@section('head')
<style>

</style>
@endsection

@section('title')
{{$profile->user->name}}
@endsection

@section('main')

{{-- <div class="container">
    <div class="row">
        <div class="col">
            <!-- Squeezers-----------------------------------> --}}

            <div class="container py-5">

                <!-- row 1 -->
                <div class="row">
                    <!-- left panel -->
                    <div class="col-6">

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
                                            <img class="w-100 rounded" src={{asset($profile->image->first()->path)}}
                                                alt="profile image">

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
                                        <h3 class="font-weight-bold">
                                            {{$profile->user->name}}
                                        </h3>
                                        <h6 class="text-muted font-weight-lighter">
                                            {{$profile->field->implode('name', ', ')}}
                                        </h6>
                                        <h5 class="text-secondary">
                                            {{$profile->position->implode('name', ', ')}}
                                        </h5>

                                    </div><!-- end inner col 2 -->
                                </div> <!-- inner row -->

                            </div> <!-- end card body -->

                        </div> <!-- end card -->

                    </div> <!-- end col 1 -->
                </div> <!-- end row 1 -->


                <!-- row location -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        <!-- location -->
                        <div class="pl-3">
                            <h6>
                                @include('components.SVG-location')
                                <span class="text-muted font-weight-light">
                                    {{$profile->location->first()->township->name}},
                                    {{$profile->location->first()->province->name}},
                                    {{$profile->location->first()->area_code->name}},
                                </span>
                            </h6>
                        </div>

                    </div> <!-- end col 1 -->
                </div> <!-- end row location -->


                <!-- row 2 -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-7 ">

                        <!-- About me -->
                        <div>
                            <h5 class="font-weight-light" style="color:grey">About</h5>
                            <p class="m-0 p-3">{{$profile->about}}</p>
                        </div>

                    </div> <!-- end col 1 -->
                </div> <!-- end row 2 -->


                <!-- row 3 -->
                <div class="row mt-4">
                    <!-- column 1 -->
                    <div class="col-8">

                        <!-- Credentials -->
                        <h5 class="font-weight-light" style="color:grey">Credentials</h5>
                        <div class="p-3">
                            @forelse ($profile->credential as $credential)
                            <div class="row">
                                <div class="col-4">
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
                        </div> <!-- end credentials -->

                    </div> <!-- end col 1 -->
                </div> <!-- end row 3 -->


                <!-- row 4 -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        <!-- Experience -->
                        <h5 class="font-weight-light" style="color:grey">Experience</h5>
                        <div class="p-3">
                            @forelse ($profile->experience as $experience)
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
                        </div> <!-- end experiences -->

                    </div> <!-- end col 1 -->
                </div> <!-- end row 4 -->


                <!-- row 5 -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        <!-- References -->
                        <h5 class="font-weight-light" style="color:grey">References</h5>
                        <div class="p-3">
                            @forelse ($profile->reference as $reference)
                            <q class="text-center font-weight-light font-italic">{{$reference->body}}</q>
                            <div class="m-3">
                                <div class="d-flex justify-content-end">
                                    <a class="text-reset text-decoration-none"
                                        href={{secure_url($reference->user->profile->path())}}>
                                        <div class="card rounded-lg">
                                            <div class="d-flex align-items-center p-1">
                                                <img class="rounded m-1" style="width:2rem"
                                                    src={{asset($reference->user->profile->image->first()->path)}}
                                                    alt="reference image">
                                                <span class="m-1 font-weight-bold">{{$reference->user->name}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p>No references... <a href="">add one!</a></p>
                            @endforelse
                        </div> <!-- end references -->

                    </div> <!-- end col 1 -->
                </div> <!-- end row 5 -->


                <!-- row 6 -->
                <div class="row mt-4">
                    <!-- col 1 -->
                    <div class="col-8">

                        <!-- Colleagues // People who you have given references too-->
                        <h5 class="font-weight-light" style="color:grey">Colleagues</h5>
                        <div class="p-3">
                            <div class="row">
                                @forelse ($profile->user->reference->map->profile as $profile)
                                <div class="col-2">

                                    <div class="card">
                                        <img class="w-100" src={{url($profile->image->first()->path)}}
                                            alt="Colleague Image">
                                    </div>
                                </div>
                                @empty
                                No Colleagues
                                @endforelse
                            </div>
                        </div>

                    </div> <!-- end col 1 -->
                </div> <!-- end row 6 -->


            </div> <!-- end container -->


            {{-- <!-- end Squeezers----------------------------------->
        </div>
    </div>
</div> --}}

@endsection