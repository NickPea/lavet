{{--  --}}


<style>


</style>


<!-- ------------------------------------------------------------------------------------------- -->


<!-- search results -->
<div class="container my-4">
    <div class="row">
        <div class="col">


            <div class="row">
                <div class="col">
                    <h6>{{$results->count()}} results found</h6>
                </div>
            </div>


            @if($results->count()>0)
            <!-- show results -->
            <div class="row">
                @foreach ($results as $model)

                @switch(get_class($model))

                @case('App\Profile')
                    <div class="col-6 offset-5 mb-3">
                        @include('search.components.card-profile')
                    </div>
                @break

                @case('App\Listing')
                    <div class="col-6 offset-5">
                        @include('search.components.card-listing')
                    </div>
                @break

                @case('App\Event')
                    <div class="col-4">
                        @include('search.components.card-event')
                    </div>
                @break

                @default
                @break

                @endswitch

                @endforeach
            </div>

            @else
            <!-- no results -->
            <div class="row">
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