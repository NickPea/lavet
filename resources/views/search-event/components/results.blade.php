{{--  --}}


<style>

</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- results -->
<div class="search-results-wrapper">

    <!-- search-info -->
    <h5>
        Veterinary events about
        <b><u>{{old('what') != null? old('what'): 'anything'}}</u></b>, in
        <b><u>{{old('where') != null? old('where'): 'any location'}}</u></b>
    </h5>

    <!-- top-pagination -->
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center">
                @if ($results->total()!= 0)
                <h6>{{$results->firstItem().' - '.$results->lastItem()}} of {{$results->total()}} results</h6>
                @endif
                <div class="ml-auto">
                    {{$results->links()}}
                </div>
            </div>
        </div>
    </div>


    @if($results->count()>0)


    <!------------------------------------------ //FOR EACH --------------------------------------->
    @foreach ($results as $model)

    <div class="row">
        <div class="col mb-5">

            <section id="{{$model->id}}" data-intersection-observer="result-card">
                <a class="text-reset text-decoration-none" href={{url($model->path())}}>

                    <!-- card -->
                    <div class="card rounded-lg">

                        <!-- image top -->
                        <div class="position-relative">
                            <img loading="lazy" class="card-img-top" style="height: 25%"
                                src={{asset($model->image->first()->path)}} alt="">
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
                                    <img loading="lazy"
                                        style="object-fit:cover; margin-right:-15px; border-radius: 50%; width:35px; height:35px; border: 3px solid white;"
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
            </section>

        </div>
    </div>


    @endforeach
    <!------------------------------------------ //FOR EACH --------------------------------------->


    <!-- bottom-pagination -->
    <div class="row">
        <div class="col mb-4">
            <div style="border-top: 1px solid lightgrey;">
                <div class="d-flex align-items-center mt-2">
                    <h6>{{$results->firstItem().' - '.$results->lastItem()}} of {{$results->total()}} results</h6>
                    <div class="ml-auto">
                        {{$results->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @else

    <!-- inner row -->
    <div class="row">

        <!-- no results -->
        <div class="col" style="height:100vh">
            No results found
        </div>

    </div>

    @endif


</div>



<!-- ------------------------------------------------------------------------------------------- -->



<script>




</script>