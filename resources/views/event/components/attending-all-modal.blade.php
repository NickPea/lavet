{{--  --}}


<style>
    .attending-all-modal-wrapper {
        display: none;
        /*hidden on boot*/
    }

    .attending-all-backdrop {


        z-index: 999999999999999999999999999999999;


        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;

        background-color: rgba(0, 0, 0, 0.5);

        display: flex;
        justify-content: center;
        align-items: center;

    }

    .attending-all-pop-up {

        height: 500px;
        width: 500px;

        background-color: white;
        box-shadow: 0 0 10px 1px black;
        border-radius: 10px;

        scroll-behavior: smooth;
        overflow-y: auto;

        padding: 20px;
    }

    .attending-all-entry {
        height: 100%;
        width: 100%;
    }

</style>


{{-- ----------------------------------------------------------------------------- --}}



<div data-js="attending-all-modal-wrapper" class="attending-all-modal-wrapper">

    <div data-js="attending-all-backdrop" class="attending-all-backdrop">
        
        <div class="attending-all-pop-up">
            <div data-js="attending-all-modal-entry" class="attending-all-entry">hey!</div>
        </div>
        
    </div>

</div>



{{-- ----------------------------------------------------------------------------- --}}

<script>
    function AttendingAllModal () {


        //DOM
           const modalWrapper =  document.querySelector('[data-js="attending-all-modal-wrapper"]');    
           !modalWrapper&&console.error('dom query not found');
           
           const modalBackdrop =  document.querySelector('[data-js="attending-all-backdrop"]');    
           !modalBackdrop&&console.error('dom query not found');

           const modalEntry =  document.querySelector('[data-js="attending-all-modal-entry"]');    
           !modalEntry&&console.error('dom query not found');
           
        //EVENTS

            //modal opened via other component events
            //...


            //hide modal on backdrop click
            window.addEventListener('click', (e) => {
                if (e.target == modalBackdrop) {
                    store.publish({
                    type: 'event_attending_modal/hide',
                    });
                }
            });


        //RENDER

            // render display modal 
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_attending_modal_show, newState.event_attending_modal_show)) {
                    if (newState.event_attending_modal_show) {

                        modalWrapper.style.display = "block";
                    } else {

                        modalWrapper.style.display = "none";
                    }
                }//ifstatechange    
            });//render


            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_atttending_all_attendees, newState.event_atttending_all_attendees)) {

                    const formattedAttendees = newState.event_atttending_all_attendees.map((attendee) => {
                        
                        return `
                            <div class="col-4">
                                <a href="${window.location.origin}/${attendee.profile}">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="${attendee.image}">
                                        <span class="text-center">${attendee.name}</span>
                                    </div>
                                </a>
                            </div>
                        `;
                    });//map

                    formattedAttendees.unshift('<div class="row" style="height: 100px;">');
                    formattedAttendees.push('</div>');

                    modalEntry.innerHTML = formattedAttendees.join('');

                }//ifstatechange

            });//render

    }//
    AttendingAllModal();

</script>