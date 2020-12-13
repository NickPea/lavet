{{--  --}}


<style>

</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- results -->
<div class="search-results-wrapper">

    <!-- search-info -->
    <h5>
        Veterinary people concerning
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
    @foreach ($results as $profile)

    <div class="row">
        <div class="col mb-5">

            <section id="{{$profile->id}}" data-intersection-observer="result-card">

                <a class="text-reset text-decoration-none" href={{url($profile->path())}}>
                    <div class="card rounded-lg hover">
                        <div class="position-relative">
                            
                            <img class="ml-3 mt-3" style="border-radius:50%; height:100px; width:100px; object-fit:cover;" src={{asset($profile->image->first()->path)}} alt="{{$profile->user->name.' profile image'}}">
                            
                            <!-- is_free -->
                            <h5 class="position-absolute" style="top:5%; right:5%;">
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
                        <div class="card-body">
                            <h5 class="font-weight-bold">{{$profile->user->name}}</h5>
                            <h6 class="card-subtitle text-muted">{{$profile->position->implode('name', ', ')}}</h6>
                        </div>
                    </div>
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