{{--  --}}


<style>


</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- search results -->
<div class="search-results-wrapper">

    <h5>
        Veterinary events for {{old('what') != null? old('what'): 'anything'}}, in {{old('where') != null? old('where'): 'any location'}}
    </h5>


    @if($results->count()>0)

    <!-- top-pagination -->
    <div class="row">
        <div class="col mb-4">
            <div style="border-bottom: 1px solid lightgrey;">
                <div class="d-flex align-items-center">
                    <h6>{{$results->firstItem().' - '.$results->lastItem()}} of {{$results->total()}} results</h6>
                    <div class="ml-auto">
                        {{$results->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('search-event.components.scroll-indicator')

    <!-- show results -->
    @foreach ($results as $model)

    <div class="row">
        <div class="col mb-5">
            @include('search-event.components.search-result-card')
        </div>
    </div>


    @endforeach

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