{{--  --}}


<style></style>


{{-- ------------------------------------------------------------------------------------------------ --}}


<div data-js="event-hosted-by-wrapper">
    <div class="card mb-2">
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div data-js="event-hosted-by-left-entry"></div>
                </div>
                <div class="col">
                    <div data-js="event-hosted-by-right-entry"></div>
                </div>
            </div>

        </div><!-- //cardbody -->
    </div><!-- //card -->
</div><!-- //wrapper -->


{{-- ------------------------------------------------------------------------------------------------ --}}


<script>
    function EventHostedBy() {
        

        //DOM

            const hostedByWrapper = document.querySelector('[data-js="event-hosted-by-wrapper"]');
            const leftEntry = hostedByWrapper.querySelector('[data-js="event-hosted-by-left-entry"]');
            const rightEntry = hostedByWrapper.querySelector('[data-js="event-hosted-by-right-entry"]');


        //EVENTS

            //onload get state - hosted_by
            (async function() {
                const fetchData = await getEventHostedBy();
                store.publish({
                    type: 'event-hosted-by/refresh',
                    payload: fetchData.hosted_by,
                })
            })();


        //RENDER


            //render - all hosted_by
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_hosted_by, newState.event_hosted_by)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_hosted_by));

                    leftEntry.innerHTML = `
                        <a href="${window.location.origin}/${selectState.link}">
                            <img class="w-100" src="${selectState.image}">
                        </a>
                    `;

                    rightEntry.innerHTML = `
                        <span class="py-1">
                            <h6>Event hosted by</h6>
                        </span>
                        <a class="text-reset" href="${window.location.origin}/${selectState.link}">
                            <span class="py-1">
                                <b>${selectState.name}</b>
                            </span>
                        </a>
                    `;

                }//ifstatechange
            });


    }//EventHostedBy()
    document.addEventListener('DOMContentLoaded', EventHostedBy);


</script>