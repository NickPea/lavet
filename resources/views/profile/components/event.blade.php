<style>


</style>


{{-- ----------------------------------------------------------------------- --}}


<div class="content-wrapper">
    <div class="d-flex">
        <h5 class="font-weight-light" style="color:grey">Events
            ({{$profile->user->business->map->listing->count()}})
        </h5>
        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('svg.more')
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item font-weight-bold">Action</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="row">
                @forelse($profile->user->event as $event)
                <div class="col-6">
                    <a href={{secure_url($event->path())}}>
                        <img class="img-thumbnail"
                            src={{url($event->image->first()->path)}}
                            alt="Colleague Image">
                    </a>
                    <a class="text-reset" href={{secure_url($event->path())}}>
                        <b>{{$event->title}}</b>
                    </a>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>


{{-- ----------------------------------------------------------------------- --}}


<script>



</script>