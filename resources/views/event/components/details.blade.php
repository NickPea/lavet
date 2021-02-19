{{--  --}}



<style>




</style>



{{-- ------------------------------------------------------------------------------------------- --}}


<div data-js="event-details-wrapper">
    <div class="card my-2">
        <div class="card-body">


            <!-- acccess -->
            <span class="row my-2">
                <div class="col-1">
                    <i>@include('svg.public')</i>
                </div>
                <div class="col">
                    <div data-js="event-details-access-entry"></div>
                </div>
            </span>


            <!-- when-start -->
            <span class="row my-2">
                <div class="col-1">
                    <i>@include('svg.today')</i>
                </div>
                <div class="col-10">
                    <div data-js="event-details-when-start-entry"></div>
                </div>
            </span>


            <!-- time -->
            <span class="row my-2">
                <div class="col-1">
                    <i>@include('svg.time')</i>
                </div>
                <div class="col-10">
                    <div data-js="event-details-time-entry"></div>
                </div>
            </span>


            <!-- location -->
            <span class="row my-2">
                <div class="col-1">
                    <i>@include('svg.location')</i>
                </div>
                <div class="col-10">
                    <div data-js="event-details-location-entry"></div>
                </div>
            </span>


        </div><!-- //card-body -->
    </div><!-- //card -->
</div>



{{-- ------------------------------------------------------------------------------------------- --}}



<script>
    function EventDetails() {
        

        //DOM

            const detailsWrapper = document.querySelector('[data-js="event-details-wrapper"]');
            const accessEntry = detailsWrapper.querySelector('[data-js="event-details-access-entry"]');
            const whenDateStartEntry = detailsWrapper.querySelector('[data-js="event-details-when-start-entry"]');
            const whenTimeEntry = detailsWrapper.querySelector('[data-js="event-details-time-entry"]');
            const locationEntry = detailsWrapper.querySelector('[data-js="event-details-location-entry"]');


        //EVENTS


            // onload fetch state - access
            (async function () {
                const fetchData = await getEventAccess();
                store.publish({
                    type: 'event-access/refresh',
                    payload: fetchData.access,
                });
            })();
            // onload fetch state - when
            (async function () {
                const fetchData = await getEventWhen();
                store.publish({
                    type: 'event-when/refresh',
                    payload: fetchData.when,
                });
            })();
           
            // onload fetch state - location
            (async function () {
                const fetchData = await getEventLocation();
                store.publish({
                    type: 'event-location/refresh',
                    payload: fetchData.location,
                });
            })();


        //RENDER


            //render - access
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_access, newState.event_access)) {

                    accessEntry.innerHTML = `
                        <b>${newState.event_access}</b>
                    `;

                }//ifstatechange
            });

            //render - when
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_when, newState.event_when)) {

                    whenDateStartEntry.innerHTML = `
                        <b>${newState.event_when.start_date_formatted}</b>
                    `;

                    whenTimeEntry.innerHTML = `
                        <b>${newState.event_when.start_time_formatted} to ${newState.event_when.end_time_formatted}</b>
                    `;

                }//ifstatechange
            });
           
            //render - location
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_location, newState.event_location)) {

                    locationEntry.innerHTML = `
                            <b>${newState.event_location.township}</b>
                            <b>${newState.event_location.city}</b>
                            <b>${newState.event_location.province}</b>
                            <b>${newState.event_location.country}</b>
                            <b>${newState.event_location.area_code}</b>
                        `;

                }//ifstatechange
            });





    }//EventDetails()
    document.addEventListener('DOMContentLoaded', EventDetails);


</script>