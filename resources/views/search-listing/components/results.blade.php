{{--  --}}


<style>

</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- results -->
<div class="search-results-wrapper">

    <!-- search-info -->
    <h5>
        Veterinary jobs as
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
    @foreach ($results as $listing)

    <div class="row">
        <div class="col mb-5">

            <section id="{{$listing->id}}" data-intersection-observer="result-card">


                <a class="text-reset text-decoration-none" href={{url($listing->path())}}>
                    <div class="card rounded-lg hover">
                        <div class="card-header">
                            {{$listing->position->implode('name', ', ')}}
                        </div>
                
                        <div class="card-body">
                
                            <!-- business -->
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted m-0">{{$listing->business->name}}</h6>
                                </div>
                                <div class="col-3">
                                    <img class="w-100 rounded-lg" src={{$listing->business->image->first()->path}} alt="">
                                </div>
                            </div>
                
                            <!-- title -->
                            <div class="row mt-3">
                                <div class="col">
                                    <h5 class="font-weight-bold">{{$listing->title}}</h5>
                                </div>
                            </div>
                
                            <!-- summary -->
                            <div class="row mt-2">
                                <div class="col">
                
                                    <div class="row">
                                        <div class="col-2">
                                            <i>@include('svg.pay')</i>
                                        </div>
                                        <b>{{$listing->pay_rate}}</b>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-2">
                                            <i>@include('svg.briefcase')</i>
                                        </div>
                                        <b>{{$listing->employ_type->implode('name', ', ')}}</b>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-2">
                                            <i>@include('svg.location')</i>
                                        </div>
                                        <b>{{$listing->location->first()->area_code->name}}</b>
                                    </div>
                
                
                
                                </div><!-- end col -->
                            </div><!-- end row -->
                
                
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
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