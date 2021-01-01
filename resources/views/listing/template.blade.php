@extends('layouts.templates.app')


@push('head')
<style>

</style>
@endpush


@push('body')

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <!-- Squeezers----------------------------------->

            <div class="container py-5">

                <!-- row 1 -->
                <div class="row">

                    <!-- col 1 -->
                    <div class="col-5 d-flex flex-column">

                        <!-- title, field, position, business-name & location -->
                        <div class="mt-5">
                            <h2 class="font-weight-bold">
                                {{$listing->title}}
                            </h2>
                        </div>

                        <div class="mt-auto">
                            <h5 class="text-muted font-weight-lighter">
                                {{$listing->field->implode('name', ', ')}}
                            </h5>
                            <h1 class="text-secondary">
                                {{$listing->position->implode('name', ', ')}}
                            </h1>
                        </div>

                        <div class="my-5">
                            <h5 class="text-secondary">
                                {{$listing->business->name}}
                            </h5>
                            <h6>
                                @include('svg.location')
                                <span class="text-muted font-weight-light">
                                    {{$listing->location->first()->city->name}},
                                    {{$listing->location->first()->province->name}},
                                    {{$listing->location->first()->area_code->name}},
                                    {{$listing->location->first()->country->name}},
                                </span>
                            </h6>
                        </div>

                    </div><!-- end col 1 -->

                    <!-- col 2 -->
                    <div class="col-7">

                        <!-- Card -->
                        <div class="card p-2 rounded-lg shadow-lg">

                            <!-- Card Body-->
                            <div class="card-body">

                                <!-- overlay wrapper -->
                                <div class="position-relative">
                                    <!-- image -->
                                    <img class="w-100 rounded" src={{asset($listing->image->first()->path)}}
                                        alt="listing image">

                                    <!-- image overlay -->
                                    <div class="position-absolute" style="bottom:3%; left:3%">

                                        <!-- tags -->
                                        <h5>
                                            <span class="badge badge-primary border py-2">
                                                new
                                            </span>
                                        </h5>

                                    </div>
                                    <!-- end image overlay -->
                                </div>
                                <!-- end overlay wrapper -->

                            </div> <!-- end card body -->

                        </div> <!-- end card -->

                    </div> <!-- end col 2 -->
                </div> <!-- end row 1 -->

            </div> <!-- end container 1 -->


            <!-- background container wrapper -->
            <div style="background-color: rgba(255, 160, 122, 0.1)">
                <!-- container 2 -->
                <div class="container">
                    <!-- row 1 -->
                    <div class="row ">
                        <div class="col-8">
                            <!-- listing main -->
                            <div class="card my-5">
                                <div class="card-body">
                                    <div>
                                        <!-- position main -->
                                        <h5 class="card-title text-muted font-weight-lighter">Role</h5>
                                        <p class="p-3">
                                            {{$listing->about}}
                                        </p>
                                    </div>
                                    <div>
                                        <!-- business main -->
                                        <h5 class="card-title text-muted font-weight-lighter">Business</h5>
                                        <figure>
                                            <img class="mx-3 my-1 float-left" style="width:100px; height:100px; border-radius:2rem; object-fit:cover"
                                                src={{asset($listing->business->image->first()->path)}} alt="">
                                            <figcaption>
                                                <b>
                                                    {{$listing->business->name}}
                                                </b>
                                            </figcaption>
                                        </figure>
                                        <p class="px-3">
                                            {{$listing->business->about}}
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end listing main -->
                        </div>

                        <!-- col 2 -->
                        <div class="col-4">

                            <!-- apply/save card -->
                            <div class="card mt-5">
                                <div class="card-body">
                                    <button class="btn btn-primary btn-lg btn-block">Apply Now</button>
                                </div>
                            </div>

                            <!-- summary card -->
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <span class="py-1"><i class="mx-3">@include('svg.today')</i>
                                            <b>{{$listing->created_at->diffForHumans()}}</b></span>
                                        <span class="py-1"><i class="mx-3">@include('svg.briefcase')</i>
                                            <b>{{$listing->employ_type->implode('name', ', ')}}</b></span>
                                        <span class="py-1"><i class="mx-3">@include('svg.pay')</i>
                                            <b>{{$listing->pay_rate}}</b></span>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end col 2 -->
                    </div> <!-- end row 1 -->

                </div> <!-- container 2 -->
            </div> <!-- end background container wrapper -->

<!-- end Squeezers -------------------------------------->
</div>
</div>
</div>

@endpush