
<div class="row">
    <div class="col">
        <h6>{{$data->count()}} results found</h6>
    </div>
</div>


@if($data->count()>0)
<!-- show results -->
 <div class="row">
    @foreach ($data as $model)

    @switch(get_class($model))
    @case('App\Profile')

    <div class="col-3">
        @include('search.profile-card')
    </div>

    @break
    @case('App\Listing')

    <div class="col-3">
        @include('search.listing-card')
    </div>

    @break
    @case('App\Event')

    <div class="col-4">
        @include('search.event-card')
    </div>


    @break
    @default

    @endswitch
    @endforeach
</div>
    
@else
<!-- no results -->
<div class="row">
    <div class="col" style="height:100vh">

    </div>
</div>

@endif