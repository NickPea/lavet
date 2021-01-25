{{--  --}}


<style>


</style>


{{-- ----------------------------------------------------------------------------------------------- --}}


<!-- rsvp card -->
<div class="card my-2">
    <div class="card-body">
        <div class="row">

            <span class="col-7 d-flex justify-content-center align-items-center text-center">

                <b>
                    <span>
                        @if ($event->end_at->isPast())
                        Event Finished
                        @else
                        <span>
                            @if ($event->seat_num === null)
                            Unlimited Attendance
                            @else
                            <span>
                                @if ($event->rsvp->count() >= $event->seat_num)
                                Event Full
                                @else
                                Remaining Seats : {{$event->seat_num - $event->rsvp->count()}}
                                @endif
                            </span>
                            @endif
                        </span>
                        @endif
                    </span>
                </b>
            </span>

            <span class="col">

                <button data-js="event-rsvp-button" class="btn btn-primary btn-lg btn-block
                {{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'disabled btn-secondary':''}}"
                    style="{{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'cursor: not-allowed':''}}">
                    Rsvp
                </button>
            </span>

        </div>
    </div>
</div>


{{-- -----------------------------------------------------------------------------------------------  --}}


<script>

    function EventRsvp() {

        //DOM
        const rsvpButton = document.querySelector('[data-js="event-rsvp-button"]');
        !rsvpButton&&console.error('dom query not found');

        //EVENTS
        rsvpButton.addEventListener('click', async (e) => {
            e.preventDefault();

            //open modal with...
            store.publish({
                type: 'event-rsvp-prompt/show'
            });
            
            //prompt to select a status and leave a comment with a modal
            
        });

        //RENDER

        
    }//EventRsvp()
    EventRsvp();

</script>