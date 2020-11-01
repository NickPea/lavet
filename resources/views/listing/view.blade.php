@extends('layouts.app')

@section('head')
<style>

</style>
@endsection

@section('title')
{{$listing->title}}
@endsection

@section('main')

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
                                @include('components.SVG-location')
                                <span class="text-muted font-weight-light">
                                    {{$listing->location->first()->township->name}},
                                    {{$listing->location->first()->province->name}},
                                    {{$listing->location->first()->area_code->name}},
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
                                            <img class="w-25 mx-3 my-1 float-left"
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
                                        <span class="py-1"><i class="mx-3">@include('components.svg-today')</i>
                                            <b>{{$listing->created_at->diffForHumans()}}</b></span>
                                        <span class="py-1"><i class="mx-3">@include('components.svg-briefcase')</i>
                                            <b>{{$listing->employ_type->implode('name', ', ')}}</b></span>
                                        <span class="py-1"><i class="mx-3">@include('components.svg-pay')</i>
                                            <b>{{$listing->pay_rate}}</b></span>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end col 2 -->
                    </div> <!-- end row 1 -->

                </div> <!-- container 2 -->
            </div> <!-- end background container wrapper -->



            {{-- 
<!-- row 2 -->
<div class="row mt-4">
    <!-- col 1 -->
    <div class="col-7 ">

        <!-- About me -->
        <div>
            <h5 class="font-weight-light" style="color:grey">About</h5>
            <p class="m-0 p-3">{{$listing->about}}</p>
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
            @forelse ($listing->credential as $credential)
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
            @forelse ($listing->experience as $experience)
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
            @forelse ($listing->reference as $reference)
            <q class="text-center font-weight-light font-italic">{{$reference->body}}</q>
            <div class="m-3">
                <div class="d-flex justify-content-end">
                    <a class="text-reset text-decoration-none" href={{secure_url($reference->user->listing->path())}}>
                        <div class="card rounded-lg">
                            <div class="d-flex align-items-center p-1">
                                <img class="rounded m-1" style="width:2rem"
                                    src={{asset($reference->user->listing->image->first()->path)}}
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
                @forelse ($listing->user->reference->map->listing as $listing)
                <div class="col-2">

                    <div class="card">
                        <img class="w-100" src={{url($listing->image->first()->path)}} alt="Colleague Image">
                    </div>
                </div>
                @empty
                No Colleagues
                @endforelse
            </div>
        </div>

    </div> <!-- end col 1 -->
</div> <!-- end row 6 --> --}}

</div> <!-- end container -->


<!-- end Squeezers -------------------------------------->
</div>
</div>
</div>

@endsection