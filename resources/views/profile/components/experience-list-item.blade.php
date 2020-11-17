<div class="card rounded-lg">
    <div class="card-body">

        <!-- outter row 1-->
        <div class="row">

            <!-- col 1 -->
            <div class="col-1">
                @include('svg.experience')
            </div>

            <!-- col 2 -->
            <div class="col">

                <!-- inner row 1 -->
                <div class="row">
                    <div class="col">

                        <!-- description -->
                        <div class="font-weight-bold">
                            <div class="d-flex align-items-center">
                                <h5 class="d-inline m-0">
                                    {{$experience->work_role}}
                                </h5>

                                <div class="btn-group ml-auto">
                                    <a href="" class="options-button" data-toggle="dropdown">
                                        @include('svg.remove')
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item font-weight-bold"
                                            onclick="removeExperience({{$experience->id}});">
                                            Remove
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <span class="text-muted ">at</span>
                                <span class="d-inline">
                                    <span>{{$experience->organisation}}</span>
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- inner row 2 -->
                <div class="row">
                    <div class="col">

                        @isset($experience->start_at)
                        <span>{{$experience->start_at->format('M-Y')}}</span>
                        @endisset
                        <span>to</span>
                        @isset($experience->end_at)
                        <span>{{$experience->end_at->format('M-Y')}}</span>
                        @else
                        Current
                        @endisset

                    </div>
                </div><!-- inner row 2 of col 2 -->

            </div> <!-- //col 2 -->
            <!-- col 3 -->

        </div><!-- outter row -->

    </div><!-- //card-body -->
</div><!-- //card -->