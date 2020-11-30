{{--  --}}





<a class="text-reset text-decoration-none" href={{url($model->path())}}>
    <div class="card rounded-lg hover">
        <div class="card-header">
            {{$model->position->implode('name', ', ')}}
        </div>

        <div class="card-body">

            <!-- business -->
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle text-muted m-0">{{$model->business->name}}</h6>
                </div>
                <div class="col-3">
                    <img class="w-100 rounded-lg" src={{$model->business->image->first()->path}} alt="">
                </div>
            </div>

            <!-- title -->
            <div class="row mt-3">
                <div class="col">
                    <h5 class="font-weight-bold">{{$model->title}}</h5>
                </div>
            </div>

            <!-- summary -->
            <div class="row mt-2">
                <div class="col">

                    <div class="row">
                        <div class="col-2">
                            <i>@include('svg.pay')</i>
                        </div>
                        <b>{{$model->pay_rate}}</b>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <i>@include('svg.briefcase')</i>
                        </div>
                        <b>{{$model->employ_type->implode('name', ', ')}}</b>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <i>@include('svg.location')</i>
                        </div>
                        <b>{{$model->location->first()->area_code->name}}</b>
                    </div>



                </div><!-- end col -->
            </div><!-- end row -->


        </div> <!-- end card-body -->
    </div> <!-- end card -->
</a>

