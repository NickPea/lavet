{{--  --}}


<style>


</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- search results -->
<div class="container my-4">
    <div class="row">
        <div class="col">


            @if($results->count()>0)
            
            <!-- inner row -->
            <div class="row">

                <div class="col-6 offset-1 mb-3">
                    <div style="border-bottom: 1px solid lightgrey;">
                            <h6>{{$results->count()}} jobs found</h6>
                    </div>
                </div>
                
                <!-- show results -->
                @foreach ($results as $model)

                <div class="col-6 offset-1 mb-3">
                    @include('search-listing.components.search-result-card')
                </div>

                @endforeach

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
    </div>
</div>


<!-- ------------------------------------------------------------------------------------------- -->



<script>




</script>