{{-- ------------------------------------------------------------------------------- --}}

<div class="content-wrapper">

    <!-- title -->
    <div class="d-flex">
        <h5 class="font-weight-light" style="color:grey">Credentials
            ({{$profile->credential->count()}}) </h5>
        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('svg.more')
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item font-weight-bold">Action</a>
            </div>
            <a id="js-pc-add-button" class="options-button">
                @include('svg.add')
            </a>
        </div>
    </div>

    <div id="js-pc-form-wrapper">
        {{--  --}}
    </div>

    <!-- cards -->
    <div id="js-pc-main-wrapper">
        @forelse ($profile->credential->take(2) as $credential)

        <div class="row">
            <div class="col">

                <div class="card rounded-lg " style="height:25vh;">
                    <div class="card-body text-center d-flex flex-column justify-content-around">
                        <small class="text-muted">{{$credential->institution}}</small>
                        <h5 class="card-title font-italic">{{$credential->name}}</h6>
                            <h6 class="card-text">{{$credential->end_year}}</h6>
                    </div>
                </div>

            </div><!-- //col -->
        </div><!-- //row -->

        @empty
        No Credentials...
        @endforelse
    </div>


</div><!-- //content-wrapper -->
