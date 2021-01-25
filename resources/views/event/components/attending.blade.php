{{--  --}}

<style>


</style>


{{-- --------------------------------------------------------------------------------------------------- --}}


<!-- attending card -->
<div class="card my-2">
    <div class="card-body">

        <div class="d-flex">

            <!-- count -->
            <h5 data-js="event-attending-count" class="card-title text-muted font-weight-lighter"></h5>

            <!-- see all attending link -->
            <small class="ml-auto">
                <a data-js="event-attending-see-all-link" href="">See all</a>
            </small>
        </div>

        <!-- some attending -->
        <div data-js="event-some-attending-entry" class="row"></div>

    </div>
</div>


{{-- --------------------------------------------------------------------------------------------------- --}}


<script>
    async function EventAttending() {

        //DOM

        const seeAllLink = document.querySelector('[data-js="event-attending-see-all-link"]');
        const attendingCount = document.querySelector('[data-js="event-attending-count"]');
        const someAttendingEntry = document.querySelector('[data-js="event-some-attending-entry"]');


        //EVENTS

            //get count and some attending onload
            (async function () {
                const someAttendingData = await getEventSomeAttending();
                store.publish({
                    type: 'event-some-attending/refresh',
                    payload: someAttendingData,
                });

                const attendingCount = await getAttendingCount();
                store.publish({
                    type: 'event-attending-count/refresh',
                    payload: attendingCount,
                });

            })();
            

            //open attending all modal component through store on click
            seeAllLink.addEventListener('click', async (e) => {
                e.preventDefault();

                const data = await getEventAttendingAllAttendess();
                store.publish({
                    type: 'event-attending-all-attendees/refresh',
                    payload: data,
                });

                store.publish({
                    type: 'event-attending-modal/show'
                });

            });//


        //RENDER

            //render Attending Count
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_attending_count, newState.event_attending_count)) {

                    attendingCount.innerHTML = `Attending: ${newState.event_attending_count}`;

                }//ifstatechange
            });

            //render Some Attending
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_some_attending, newState.event_some_attending)) {

                    const someAttendingFormatted = newState.event_some_attending.map((attendee) => {
                        return `
                            <div class="col-4">
                                <a class="text-reset" href="${attendee.profile}">
                                    <img class="img-thumbnail" src="${attendee.image}">
                                </a>
                                <a class="text-reset" href="${attendee.profile}">
                                    ${attendee.name}
                                </a>
                            </div>
                        `;
                    });
                    someAttendingEntry.innerHTML = someAttendingFormatted.join('');
                    
                }//ifstatechange
            });


    }//EventAttending();
    document.addEventListener('DOMContentLoaded', EventAttending);


</script>