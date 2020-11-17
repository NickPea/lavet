
<div>
    <h6 class="d-inline">
        @include('svg.location')
        @if ($profile->location->first())
        <span class="text-muted font-weight-light">
            {{$profile->location->first()->city->name}},
            {{$profile->location->first()->province->name}},
            {{$profile->location->first()->country->name}},
            {{$profile->location->first()->area_code->name}},
        </span>
        @else
        <span class="text-muted font-weight-light">
            Unknown
            @endif
    </h6>
</div>