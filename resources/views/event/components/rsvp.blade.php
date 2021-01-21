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
                <button
                    class="btn btn-primary btn-lg btn-block
                {{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'disabled btn-secondary':''}}"
                    style="{{$event->rsvp->count() >= $event->seat_num || $event->end_at->isPast()?'cursor: not-allowed':''}}">
                    Attend
                </button>
            </span>
        </div>
    </div>
</div>


{{-- -----------------------------------------------------------------------------------------------  --}}


<script>


</script>
