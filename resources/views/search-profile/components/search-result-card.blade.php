{{--  --}}

    
    <a class="text-reset text-decoration-none" href={{url($model->path())}}>
        <div class="card rounded-lg hover">
            <div class="position-relative">
                
                <img class="ml-3 mt-3" style="border-radius:50%; height:100px; width:100px; object-fit:cover;" src={{asset($model->image->first()->path)}} alt="{{$model->user->name.' profile image'}}">
                
                <!-- is_free -->
                <h5 class="position-absolute" style="top:5%; right:5%;">
                    @if ($model->is_free===1)
                    <span class="badge badge-success border py-2">
                        Online
                    </span>
                    @else
                    <span class="badge badge-secondary border py-2">
                        Offline
                    </span>
                    @endif
                </h5>
                
            </div>
            <div class="card-body">
                <h5 class="font-weight-bold">{{$model->user->name}}</h5>
                <h6 class="card-subtitle text-muted">{{$model->position->implode('name', ', ')}}</h6>
            </div>
        </div>
    </a>
    
