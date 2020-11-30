{{--  --}}



    <a class="text-reset text-decoration-none" href={{url($model->path())}}>

        <!-- card -->
        <div class="card rounded-lg hover">

            <!-- image top -->
            <div class="position-relative">
                <img class="card-img-top" style="height: 25%" src={{asset($model->image->first()->path)}} alt="">
                <div class="position-absolute d-flex flex-column" style="top:5px; left:5px;">
                    @forelse ($model->tag as $tag)
                    <small style="margin-bottom: 2px;">
                        <span class="border border-secondary rounded-lg bg-white px-1 font-weight-bold">
                            {{$tag->name}}
                        </span>
                    </small>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="card-body">
                <!-- datetime -->
                <h6 class="text-uppercase text-muted">
                    <span class="font-weight-bold">
                        {{$model->start_at->format('D, M d, g:ma')}}
                    </span>
                </h6>

                <!-- title -->
                <h5 class="text-capitalize font-weight-bold">
                    {{$model->title}}
                </h5>

                <!-- comment count -->
                <div>
                    @include('svg.comment')
                    <span>
                        ({{$model->comment->count()}}) Comments
                    </span>
                </div>

                <!-- attending stacked avatars count-->
                <div>
                    <span style="margin-right:15px">
                        @forelse ($model->rsvp->map->user->take(3) as $user)
                        <img style="object-fit:cover; margin-right:-15px; border-radius: 50%; width:35px; height:35px; border: 3px solid white;"
                            src={{$user->profile->image->first()->path}} alt="user image">
                        @empty
                        (0) Attending
                        @endforelse
                    </span>
                    @if ($model->rsvp->count()>0)
                    <span>({{$model->rsvp->map->user->count()}}) Attending</span>
                    @endif
                </div>



            </div><!-- //card-body -->
        </div> <!-- //card -->
    </a>
