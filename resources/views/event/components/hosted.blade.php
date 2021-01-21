{{--  --}}


<style></style>


{{-- ------------------------------------------------------------------------------------------------ --}}


<!-- hosted by card -->
<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <a href={{secure_url($event->user->profile->path())}}>
                    <img class="w-100" src={{asset($event->user->profile->image->first()->path)}}
                        alt="hosted by image">
                </a>
            </div>
            <div class="col">
                <span class="py-1">
                    <h6>Event hosted by</h6>
                </span>
                <a class="text-reset" href={{secure_url($event->user->profile->path())}}>
                    <span class="py-1">
                        <b>{{$event->user->name}}</b>
                    </span>
                </a>
            </div>
        </div>
    </div><!-- end card body -->
</div><!-- end card -->


{{-- ------------------------------------------------------------------------------------------------ --}}


<script></script>