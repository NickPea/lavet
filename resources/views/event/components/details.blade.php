{{--  --}}


<style>


</style>



{{-- ------------------------------------------------------------------------------------------- --}}


<!-- summary card -->
<div class="card my-2">
    <div class="card-body">
        <span class="row my-2">
            <div class="col-1">
                <i>
                    @if ($event->access=='Public')
                    @include('svg.public')
                    @else
                    @include('svg.private')
                    @endif
                </i>
            </div>
            <div class="col-10">
                <b>{{$event->access}}</b>
            </div>
        </span>
        <span class="row my-2">
            <div class="col-1">
                <i>@include('svg.today')</i>
            </div>
            <div class="col-10">
                <b>{{$event->start_at->format('l jS \\of F Y')}}</b>
            </div>
        </span>
        <span class="row my-2">
            <div class="col-1">
                <i>@include('svg.time')</i>
            </div>
            <div class="col-10">
                <b>{{$event->start_at->format('g:i A')}} to {{$event->end_at->format('g:i A')}}</b>
            </div>
        </span>
        <span class="row my-2">
            <div class="col-1">
                <i>@include('svg.location')</i>
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



{{-- ------------------------------------------------------------------------------------------- --}}



<script>


</script>