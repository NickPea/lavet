{{--  --}}

<style>


    /** show-edit-modal-button */

    .header-show-edit-modal-button-wrapper {
        display: flex;
        flex-flow: row nowrap;
        margin: 0 0 8px;
    }

    .header-show-edit-modal-button-wrapper span {
        margin-left: auto;

        padding: 5px 10px;

        border-radius: 5px;
        background-color: white;
        border: 1px solid grey;

        text-align: center;
        font-weight: bold;

        cursor: pointer;
    }

    .header-show-edit-modal-button-wrapper span:hover {
        box-shadow: 0 0 3px 1px grey;
    }

    .header-show-edit-modal-button-wrapper span:active {
        box-shadow: 0 0 0 0;
        transform: scale(0.95);
    }

    /* // */

</style>


{{-- ------------------------------------------------------------------------------------------------ --}}


<!-- event header -->
<div data-js="event-header-wrapper">
    
    <div class="card" style="background-color: white">
        <div class="container my-5">
            <div class="row">
    
                <div class="col-9">
    
                    <!-- datetime -->
                    <div data-js="event-header-when-start-entry"></div>
    
                    <!-- title -->
                    <div data-js="event-header-title-entry"></div>
    
                </div><!-- //col -->
    
                <div class="col">
    
                    <!-- show edit modal button -->
                    <div class="header-show-edit-modal-button-wrapper">
                        <span data-js="header-show-edit-modal-button">Edit</span>
                    </div>
    
                </div><!-- //col -->
    
            </div>
        </div>
    </div>
    
</div>


{{-- ------------------------------------------------------------------------------------------------ --}}


<script>

    function EventHeader() {

        //DOM
        
            const headerWrapper = document.querySelector('[data-js="event-header-wrapper"]');
            const whenStartEntry = headerWrapper.querySelector('[data-js="event-header-when-start-entry"]');
            const titleEntry = headerWrapper.querySelector('[data-js="event-header-title-entry"]');

            //--  edit modal button
            const showEditModalButton = document.querySelector('[data-js="header-show-edit-modal-button"]');

            
        //EVENTS

            //onload get state - title
            (async function() {
                const fetchData = await getEventTitle();
                store.publish({
                    type: 'event-title/refresh',
                    payload: fetchData.title,
                })
            })();
            

            //REDUNDANCY - CALLED IN DETAILS COMPONENT
            // //onload get state - when 
            // (async function() {
            //     const fetchData = await getEventWhen();
            //     store.publish({
            //         type: 'event-when/refresh',
            //         payload: fetchData.when,
            //     })
            // })();


            // -- on click of button show edit modal
            showEditModalButton.addEventListener('click', (e) => {
                e.preventDefault();

                store.publish({
                    type: 'event-edit-modal/show',
                });
            });//

        
        //RENDER

            //render when start
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_when, newState.event_when)) {

                    whenStartEntry.innerHTML = `
                         <h6 class="text-secondary">${newState.event_when.start_date_formatted}</h6>
                    `;

                }//ifstatechange
            });//

            //render title
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_title, newState.event_title)) {

                    titleEntry.innerHTML = `
                        <h2 class="display-5 font-weight-bold">${newState.event_title}</h2>
                    `;

                }//ifstatechange
            });//


    }
    document.addEventListener('DOMContentLoaded', EventHeader);

</script>