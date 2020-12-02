{{--  --}}


<style>


</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- search results -->
<div class="search-results-wrapper">


    @if($results->count()>0)

    <div class="row">

        <div class="col mb-4">
            <div style="border-bottom: 1px solid lightgrey;">
                <h6>{{$results->count()}} events found</h6>
            </div>
        </div>

    </div>


    <!-- show results -->
    @foreach ($results as $model)

    <div class="row">
        <div class="col mb-5">
            @include('search-event.components.search-result-card')
        </div>
    </div>


    @endforeach


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