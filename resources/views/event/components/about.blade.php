{{--  --}}


<style>

    
</style>



{{-- ------------------------------------------------------------------------------------------ --}}


<div data-js="event-about-wrapper">
    <div class="my-5">
        <h5 class="card-title text-muted font-weight-lighter">About</h5>
        <div class="row">
            <div data-js="event-about-entry" class="col-10 offset-1"></div>
        </div>
    </div>
</div>


{{-- ------------------------------------------------------------------------------------------ --}}


<script>

    function EventAbout() {


        //DOM

            const aboutWrapper = document.querySelector('[data-js="event-about-wrapper"]');
            const aboutEntry = aboutWrapper.querySelector('[data-js="event-about-entry"]');


        //EVENTS

            //onload get state
            (async function () {
                const fetchData = await getEventAbout();
                store.publish({
                    type: 'event-about/refresh', 
                    payload: fetchData.about,
                })
            })();


        //RENDER

            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_about, newState.event_about)) {

                    aboutEntry.innerHTML = `
                        <p class="text-center">${newState.event_about}</p>
                    `;

                }//ifstatechange
            });//
        
    }
    document.addEventListener('DOMContentLoaded', EventAbout);


</script>