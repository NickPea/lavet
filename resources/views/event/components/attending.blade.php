{{--  --}}


<style>


</style>


{{-- --------------------------------------------------------------------------------------------------- --}}


<!-- attending card -->
<div class="card my-2">
    <div class="card-body">

        <div class="d-flex">
            <h5 class="card-title text-muted font-weight-lighter">Attending ({{$event->rsvp->count()}})
            </h5>
            <small class="ml-auto"><a href="">See all</a></small>
        </div>
        <div class="row">
            @forelse ($event->rsvp->map->user->take(3)->shuffle() as $user)
            <div class="col-4">
                <a class="text-reset" href={{secure_url($user->profile->path())}}>
                    <img class="img-thumbnail" src={{$user->profile->image->first()->path}} alt="user image">
                </a>
                <a class="text-reset" href={{secure_url($user->profile->path())}}>
                    {{$user->name}}
                </a>
            </div>
            @empty

            @endforelse
        </div>
    </div>
</div>


{{-- --------------------------------------------------------------------------------------------------- --}}


<script>


</script>