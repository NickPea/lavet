{{--  --}}



<style>

    .event-visual-image-entry-img {
        min-width: 100%;
        max-width: 100%;
        height: 550px;
        object-fit: cover;
    }


</style>



{{-- ------------------------------------------------------------------------------------------ --}}



<div data-js="event-visual-wrapper">

    <div class="card p-2 rounded-lg shadow-lg">
        <div class="card-body">

            <!-- overlay container -->
            <div class="position-relative">

                <!-- image backdrop -->
                <div data-js="event-visual-image-entry"></div>

                <!-- overlain -->
                <div class="position-absolute" style="bottom:3%; left:3%">

                    <!-- tags -->
                    <div data-js="event-visual-tag-entry"></div>

                </div><!-- //overlain -->

            </div><!-- //overlay-container  -->


        </div> <!-- //cardbody -->
    </div> <!-- //card -->

</div><!-- //wrapper -->



{{-- ------------------------------------------------------------------------------------------ --}}


<script>
    function EventVisual() {


        //DOM

            const visualWrapper = document.querySelector('[data-js="event-visual-wrapper"]');
            const imageEntry = visualWrapper.querySelector('[data-js="event-visual-image-entry"]');
            const tagsEntry = visualWrapper.querySelector('[data-js="event-visual-tag-entry"]');


        //EVENTS

            //onload get state - image
            (async function() {
                const fetchData = await getEventImage();
                store.publish({
                    type: 'event-image/refresh',
                    payload: fetchData.image,
                });
            })();

            //onload get state - tag
            (async function() {
                const fetchData = await getEventTag();
                store.publish({
                    type: 'event-tag/refresh',
                    payload: fetchData.tag,
                });
            })();


        //RENDER

            //render - image
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_image, newState.event_image)) {

                    imageEntry.innerHTML = `
                        <img src="${newState.event_image}" class="event-visual-image-entry-img" />
                    `;

                }//ifstatechange
            });

            //render - tags
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_tag, newState.event_tag)) {

                    tagsEntry.innerHTML = newState.event_tag.map((tag) => {

                        return `
                            <h4>
                                <div class="badge badge-success border py-2">
                                    ${tag}
                                </div>
                            </h4>
                        `;
                    }).join('');

                }//ifstatechange
            });



    }//EventVisual()
    document.addEventListener('DOMContentLoaded', EventVisual);

</script>