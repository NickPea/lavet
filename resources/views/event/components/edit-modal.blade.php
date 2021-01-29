{{--  --}}


<style>
    .event-edit-modal-wrapper {
        display: none;
        /* toggle */
    }

    .event-edit-modal-backdrop {

        z-index: 99999999999999999999999999999999999999999999;

        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;

        background-color: rgba(0, 0, 0, 0.5);

        overflow-y: auto;

    }

    .event-edit-modal-content {

        height: auto;
        width: 700px;

        background-color: white;
        border-radius: 5px;

        margin: 10vh auto;
        padding: 40px;

        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;

    }

    .event-edit-modal-content-item-wrapper {

        width: 100%;

    }

    .event-edit-modal-content-title {

        color: rgb(80, 80, 80);
        font-size: 1.2rem;
        font-weight: bolder;

        border-bottom: 2px solid lightgrey;
        margin-bottom: 8px;
    }

    .event-edit-modal-entry {
        background-color: lightgrey;
        padding: 1rem;
        border-radius: 10px;
        margin: 20px 60px;

        cursor: pointer;
    }

    .event-edit-modal-entry:hover {
        background-color: rgb(230, 230, 230)
    }
</style>



{{-- ------------------------------------------------------------------------------------------ --}}



<div data-js="event-edit-modal-wrapper" class="event-edit-modal-wrapper">

    <div data-js="event-edit-modal-backdrop" class="event-edit-modal-backdrop">

        <div class="event-edit-modal-content">

            <!-- hosted by -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">Hosted by</span>
                <div data-js="event-edit-modal-hosted-by-entry" class="event-edit-modal-entry"></div>
            </div>

            <!-- title -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">Title</span>
                <div data-js="event-edit-modal-title-entry" class="event-edit-modal-entry"></div>
            </div>

            <!-- image -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">Image</span>
                <div data-js="event-edit-modal-image-entry" class="event-edit-modal-entry"></div>
            </div>

            <!-- when -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">When</span>
                <div class="event-edit-modal-entry">
                    <div data-js="event-edit-modal-when-date-entry"></div>
                    <div data-js="event-edit-modal-when-time-entry"></div>
                </div>
            </div>

            <!-- where -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">Where</span>
                <div data-js="event-edit-modal-where-entry" class="event-edit-modal-entry"></div>
            </div>

            <!-- tag -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">Tags</span>
                <div data-js="event-edit-modal-tag-entry" class="event-edit-modal-entry"></div>
            </div>

            <!-- about -->
            <div class="event-edit-modal-content-item-wrapper">
                <span class="event-edit-modal-content-title">About</span>
                <div data-js="event-edit-modal-about-entry" class="event-edit-modal-entry"></div>
            </div>


        </div><!-- //content -->
    </div><!-- //backdrop -->
</div><!-- //wrapper -->



{{-- ------------------------------------------------------------------------------------------ --}}



<script>
    function EventEditModal() {

        //DOM
        const editModalWrapper = document.querySelector('[data-js="event-edit-modal-wrapper"]');
        const editModalBackdrop = editModalWrapper.querySelector('[data-js="event-edit-modal-backdrop"]');
            //--entries
        const hostedByEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-hosted-by-entry"]');
        const titleEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-title-entry"]');
        const imageEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-image-entry"]');
        const whatEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-what-entry"]');
        const whenDateEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-when-date-entry"]');
        const whenTimeEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-when-time-entry"]');
        const whereEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-where-entry"]');
        const tagEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-tag-entry"]');
        const aboutEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-about-entry"]');

        //EVENTS

            //close edit modal on click away (backdrop click)

            editModalWrapper.addEventListener('click', (e) => {
                e.preventDefault();

                if (e.target === editModalBackdrop) {
                    store.publish({
                        type: 'event-edit-modal/hide'
                    });
                }//if

            });


        //RENDER
            
            //show modal
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_edit_modal_show, newState.event_edit_modal_show)) {

                    if (newState.event_edit_modal_show) {
                        editModalWrapper.style.display = 'block';
                    } else {
                        editModalWrapper.style.display = 'none';
                    }

                }//ifstatechange
            });
            
            //render HOSTEDBY
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_hosted_by, newState.event_hosted_by)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_hosted_by));

                    hostedByEntry.innerHTML = `
                        <div>Name: ${selectState.name}</div> 
                        <div>Image: ${selectState.image}</div> 
                        <div>Link: ${selectState.link}</div> 
                    `;

                }//ifstatechange
            });

            //render TITLE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_title, newState.event_title)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_title));

                    titleEntry.innerHTML = `
                        <div>
                            ${selectState}
                        </div>
                    `;

                }//ifstatechange
            });

            //render IMAGE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_image, newState.event_image)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_image));

                    imageEntry.innerHTML = `
                        ${selectState}
                    `;

                }//ifstatechange
            });


            //render WHAT
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_what, newState.event_what)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_what));

                    whenEntry.innerHTML = `
                        <div>${selectState}</div>
                    `;

                }//ifstatechange
            });

            //render WHEN - dates
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_when, newState.event_when)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_when));

                    whenDateEntry.innerHTML = `
                        <div> <b>Date:</b> ${selectState.start} - ${selectState.end}</div>
                    `;

                }//ifstatechange
            });

            //render WHEN - time
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_time, newState.event_time)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_time));

                    whenTimeEntry.innerHTML = `
                        <div> <b>Time:</b> ${selectState.start} - ${selectState.end}</div>
                    `;

                }//ifstatechange
            });

            //render WHERE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_location, newState.event_location)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_location));

                    whereEntry.innerHTML = `
                        <div><b>Town - </b> ${selectState.township}</div>
                        <div><b>City - </b> ${selectState.city}</div>
                        <div><b>Province - </b> ${selectState.province}</div>
                        <div><b>Country - </b> ${selectState.country}</div>
                        <div><b>Area-Code - </b> ${selectState.area_code}</div>
                    `;

                }//ifstatechange
            });

            //render TAG
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_tag, newState.event_tag)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_tag));

                    tagEntry.innerHTML = selectState.map((tag) => {
                        return `
                            ${tag}
                        `;
                    }).join('<br>');

                }//ifstatechange
            });
            
            //render ABOUT
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_about, newState.event_about)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_about));

                    aboutEntry.innerHTML = `
                        <div>${selectState}</div>
                    `;

                }//ifstatechange
            });



    }//EventEditModal
    document.addEventListener('DOMContentLoaded', EventEditModal);

</script>