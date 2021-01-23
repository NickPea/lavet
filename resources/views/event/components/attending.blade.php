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
            <small class="ml-auto">
                <a data-js="event-attending-see-all-link" href="">See all</a>
            </small>
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

    function EventAttending() {

        //DOM

        const seeAllLink = document.querySelector('[data-js="event-attending-see-all-link"]');
        !seeAllLink&&console.error('dom query not found');


        //EVENTS

            //open attending all modal component through store on click

            seeAllLink.addEventListener('click', async (e) => {
                e.preventDefault();

                const data = await getEventAttendingAllAttendess();
                store.publish({
                    type: 'event_attending_all_attendess/refresh',
                    payload: data,
                });

                store.publish({
                    type: 'event_attending_modal/show'
                });

            });//


        //RENDER




    }//EventAttending();
    EventAttending();



</script>