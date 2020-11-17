@extends('layouts.app')

@section('head')
<style>

</style>
@endsection

@section('title')
{{$event->title}}
@endsection

@section('main')


<!-- event header -->
<div class="card" style="background-color: white">
    <div class="container my-5">
        <div class="row">
            <div class="col-9">

                <div>
                    <h6 class="text-secondary">
                        {{$event->start_at->format('l jS \\of F Y')}}
                    </h6>
                </div>

                <!-- title -->
                <div>
                    <h2 class="display-5 font-weight-bold">
                        {{$event->title}}
                    </h2>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end event header -->


<!-- container 1 -->
<div class="container mt-4">

    <!-- row 1 -->
    <div class="row">

        <!-- col 1 -->
        <div class="col-8">

            <!-- Card -->
            <div class="card p-2 rounded-lg shadow-lg">

                <!-- Card Body-->
                <div class="card-body">

                    <!-- overlay wrapper -->
                    <div class="position-relative">
                        <!-- image -->
                        <img class="w-100 rounded" src={{asset($event->image->first()->path)}} alt="event image">

                        <!-- image overlay -->
                        <div class="position-absolute" style="bottom:3%; left:3%">

                            <!-- tags -->
                            @forelse ($event->tag->map->name as $tag)
                            <h4>
                                <div class="badge badge-success border py-2">
                                    {{$tag}}
                                </div>
                            </h4>
                            @empty
                            @endforelse


                        </div>
                        <!-- end image overlay -->
                    </div>
                    <!-- end overlay wrapper -->

                </div> <!-- end card body -->

            </div> <!-- end card -->

        </div> <!-- end col 1-->

        <!-- col 2 -->
        <div class="col-4 d-flex flex-column">

            <!-- hosted by card -->
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a href={{secure_url($event->user->profile->path())}}>
                                <img class="w-100" src={{asset($event->user->profile->image->first()->path)}}
                                    alt="hosted by image">
                            </a>
                        </div>
                        <div class="col">
                            <span class="py-1">
                                <h6>Event hosted by</h6>
                            </span>
                            <a class="text-reset" href={{secure_url($event->user->profile->path())}}>
                                <span class="py-1">
                                    <b>{{$event->user->name}}</b>
                                </span>
                            </a>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->

            <!-- summary card -->
            <div class="card my-2">
                <div class="card-body">
                    <span class="row my-2">
                        <div class="col-1">
                            <i>
                                @if ($event->access=='Public')
                                @include('components.svg-public')
                                @else
                                @include('components.svg-private')
                                @endif
                            </i>
                        </div>
                        <div class="col-10">
                            <b>{{$event->access}}</b>
                        </div>
                    </span>
                    <span class="row my-2">
                        <div class="col-1">
                            <i>@include('components.svg-today')</i>
                        </div>
                        <div class="col-10">
                            <b>{{$event->start_at->format('l jS \\of F Y')}}</b>
                        </div>
                    </span>
                    <span class="row my-2">
                        <div class="col-1">
                            <i>@include('components.svg-time')</i>
                        </div>
                        <div class="col-10">
                            <b>{{$event->start_at->format('g:i A')}} to {{$event->end_at->format('g:i A')}}</b>
                        </div>
                    </span>
                    <span class="row my-2">
                        <div class="col-1">
                            <i>@include('components.svg-location')</i>
                        </div>
                        <div class="col-10">
                            <b>{{$event->location->first()->township->name}}</b>
                            <b>{{$event->location->first()->city->name}}</b>
                            <b>{{$event->location->first()->province->name}}</b>
                            <b>{{$event->location->first()->country->name}}</b>
                            <b>{{$event->location->first()->area_code->name}}</b>
                        </div>
                    </span>
                </div>
            </div>

            <!-- attend card -->
            <div class="card my-2">
                <div class="card-body">
                    <div class="row">
                        <span class="col-7 d-flex justify-content-center align-items-center text-center">
                            <b>
                                <span>
                                    @if ($event->end_at->isPast())
                                    Event Finished
                                    @else
                                    <span>
                                        @if ($event->seat_num === null)
                                        Unlimited Attendance
                                        @else
                                        <span>
                                            @if ($event->rsvp->count() >= $event->seat_num)
                                            Event Full
                                            @else
                                            Remaining Seats : {{$event->seat_num - $event->rsvp->count()}}
                                            @endif
                                        </span>
                                        @endif
                                    </span>
                                    @endif
                                </span>
                            </b>

                        </span>
                        <span class="col">
                            <button
                                class="btn btn-primary btn-lg btn-block
                            {{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'disabled btn-secondary':''}}"
                                style="{{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'cursor: not-allowed':''}}">
                                Attend
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- attending card -->
            <div class="card my-2">
                <div class="card-body">

                    <div class="d-flex">
                        <h5 class="card-title text-muted font-weight-lighter">Attending ({{$event->rsvp->count()}})
                        </h5>
                        <small class="ml-auto"><a href="">See all</a></small>
                    </div>
                    <div class="row">
                        @forelse ($event->rsvp->map->user->take(3)->shuffle() as $user)
                        <div class="col-4">
                            <a class="text-reset" href={{secure_url($user->profile->path())}}>
                                <img class="img-thumbnail" src={{$user->profile->image->first()->path}}
                                    alt="user image">
                            </a>
                            <a class="text-reset" href={{secure_url($user->profile->path())}}>
                                {{$user->name}}
                            </a>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>


        </div><!-- end col 2-->

    </div> <!-- end row 1 -->

</div> <!-- end container 1 -->




<!-- background container wrapper -->
<div style="background-color: rgba(255, 160, 122, 0.1)">
    <!-- container 2 -->
    <div class="container">
        <!-- row 1 -->
        <div class="row ">
            <div class="col-8">
                <!-- event main -->

            </div>

        </div> <!-- end row 1 -->

        <div class="row">
            <div class="col-8">

                <div class="my-5">
                    <h5 class="card-title text-muted font-weight-lighter">About</h5>
                    <div class="row">
                        <div class="col-10 offset-1">
                            <p class="text-center">{{$event->about}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- container 2 -->
</div> <!-- end background container wrapper -->

<!-- wrapper div -->
<div class="my-5">
    <!-- container 1 -->
    <div class="container">
        <!-- row 1 -->
        <div class="row">
            <!-- col 1 -->
            <div class="col-8" style="border-left:rgba(193, 206, 223, 0.5) 1px solid">

                <!-- comments -->
                <h5 class="card-title text-muted font-weight-lighter">Comments</h5>
                <!-- title offset wrapper -->
                <div class="col-10 offset-1">

                    @forelse ($event->comment->where('parent_id', null) as $comment)

                    <!-- parent comments -->
                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <a href={{secure_url($comment->user->profile->path())}}>
                                <img class="w-75 rounded-lg"
                                    src={{asset($comment->user->profile->image->first()->path)}} alt="">
                            </a>
                        </div>
                        <div class="col">
                            <div class="rounded-lg p-3" style="background-color: rgba(193, 206, 223, 0.3)">
                                <div class="mb-1">
                                    <a class="text-reset" href={{secure_url($comment->user->profile->path())}}>
                                        <b class="font-weight-bold">{{$comment->user->name}}</b>
                                    </a>
                                </div>
                                <div>
                                    {{$comment->body}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <small>
                                    {{$comment->created_at->diffForHumans()}}
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- child comments -->
                    @foreach ($comment->comment_child as $child)
                    <div class="row no-gutters mt-1">
                        <div class="col-2 offset-2">
                            <a href={{secure_url($child->user->profile->path())}}>
                                <img class="w-75 rounded-lg" src={{asset($child->user->profile->image->first()->path)}}
                                    alt="">
                            </a>
                        </div>
                        <div class="col">
                            <div class="rounded-lg p-3" style="background-color: rgba(193, 206, 223, 0.3)">
                                <div class="mb-1">
                                    <a class="text-reset" href={{secure_url($child->user->profile->path())}}>
                                        <b>{{$child->user->name}}</b>
                                    </a>
                                </div>
                                <div>
                                    {{$child->body}}
                                </div>
                            </div>
                            <div class="ml-3 d-flex justify-content-end">
                                <small>
                                    {{$child->created_at->diffForHumans()}}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- end child comments -->


                    @empty
                    No Comments
                    @endforelse
                    <!-- end parent comments -->

                    <!-- leave a comment form -->
                    <form action="" method="post" class="mt-5" style=" border-top:rgba(193, 206, 223, 0.5) 1px solid">
                        <div class="row no-gutters my-4">
                            @auth
                            <div class="col-2">
                                <img class="w-75 rounded-lg" style="object-fit: cover"
                                src={{asset(Auth::user()->profile->image->first()->path)}} alt="User Image">
                            </div>
                            @endauth
                            <div class="col d-flex flex-column">
                                <textarea class="form-control" name="newComment" rows="3"
                                    placeholder="Leave a comment..."></textarea>
                                <button class="btn btn-primary align-self-end mt-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div><!-- end title offset wrapper -->

            </div><!-- end col 1 -->
        </div><!-- end row 1 -->
    </div><!-- end container -->
</div><!-- end wrapper div -->

<br>

@endsection