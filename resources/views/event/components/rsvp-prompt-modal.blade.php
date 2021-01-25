{{--  --}}

<style>
    .event-rsvp-prompt-modal-wrapper {
        display: none;
    }

    .event-rsvp-prompt-modal-backdrop {
        z-index: 999999999999999999999999;

        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;

        background-color: rgba(0, 0, 0, 0.5);

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .event-rsvp-prompt-modal-content {
        height: 500px;
        width: 500px;

        padding: 3rem;

        background-color: white;
        border-radius: 10px;
    }

    .event-rsvp-prompt-modal-content-header-wrapper {
        height: 10%;

        text-align: center;
    }

    .event-rsvp-prompt-modal-content-leave-comment-wrapper {
        height: 70%;

        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
    }

    .event-rsvp-prompt-modal-content-buttons-wrapper {
        height: 20%;

        display: flex;
        flex-flow: row nowrap;
        justify-content: space-around;
        align-items: center;
    }
</style>


{{-- ---------------------------------------------------------------------------------------------------- --}}


<div data-js="event-rsvp-prompt-modal-wrapper" class="event-rsvp-prompt-modal-wrapper">

    <div data-js="event-rsvp-prompt-modal-backdrop" class="event-rsvp-prompt-modal-backdrop">

        <div class="event-rsvp-prompt-modal-content">

            <div class="event-rsvp-prompt-modal-content-header-wrapper">
                <span style="font-size: 1.2rem; font-weight: bolder; ">Are you coming...?</span>
            </div>

            <div class="event-rsvp-prompt-modal-content-leave-comment-wrapper">

                <textarea data-js="event-rsvp-prompt-modal-content-comment-box" name="new-comment" style="height: 80%; padding: 1rem; letter-spacing: 1px;"></textarea>
                <small>* This comment is optional, and will be posted to the event wall if filled in.</small>

            </div>

            <div class="event-rsvp-prompt-modal-content-buttons-wrapper">

                <button data-js="event-rsvp-prompt-modal-content-skip-button"
                    class="btn btn-outline-secondary btn-lg">Skip this one.</button>
                <button data-js="event-rsvp-prompt-modal-content-attend-button"
                    class="btn btn-success btn-lg">I'll be there!</button>

            </div>

        </div><!-- //content -->

    </div><!-- //backdrop -->

</div><!-- wrapper -->


{{-- ---------------------------------------------------------------------------------------------------- --}}


<script>
    function RsvpPromptModal() {

        //DOM
        const modalWrapper = document.querySelector('[data-js="event-rsvp-prompt-modal-wrapper"]');
        const modalBackdrop = modalWrapper.querySelector('[data-js="event-rsvp-prompt-modal-backdrop"]');
        const commentBox = modalWrapper.querySelector('[data-js="event-rsvp-prompt-modal-content-comment-box"]');
        const skipButton = modalWrapper.querySelector('[data-js="event-rsvp-prompt-modal-content-skip-button"]');
        const attendButton = modalWrapper.querySelector('[data-js="event-rsvp-prompt-modal-content-attend-button"]');

        //EVENTS

            //hide modal on click away (onto backdrop element)
            modalWrapper.addEventListener('click', (e) => {
                
                if (e.target === modalBackdrop) { 
                    store.publish({
                        type: 'event-rsvp-prompt/hide'
                    });
                }//if
                
            })//click


            //'skip event' button click
            skipButton.addEventListener('click', async (e) => {

                //rsvp
                const rsvpData = await postRsvpToEvent('skipping');

                //authCheck
                if (rsvpData == 403) {
                    alert('Please sign in first.');
                }

                //updateAttending
                if (rsvpData != 403) {

                    const attendingCount = await getAttendingCount();
                    store.publish({
                        type: 'event-attending-count/refresh',
                        payload: attendingCount,
                    });
                    
                    const someAttendingData = await getEventSomeAttending();
                    store.publish({
                        type: 'event-some-attending/refresh',
                        payload: someAttendingData,
                    });
                }

                //updateComments
                if (rsvpData != 403 && commentBox.value !== '') {
                    const newCommentData = await postNewEventComment(commentBox.value);
                    commentBox.value = '';

                    const allCommentsData = await getEventComments();
                    store.publish({
                        type: 'event-comments/refresh', 
                        payload: allCommentsData,
                    });
                }

                //closeModal
                store.publish({
                    type: 'event-rsvp-prompt/hide',
                });

            });//skipbuttonclick
            
            
            //'attend event' button click
            attendButton.addEventListener('click', async (e) => {

                //rsvp
                const rsvpData = await postRsvpToEvent('attending');

                //authCheck
                if (rsvpData == 403) {
                    alert('Please sign in first.');
                }

                //updateAttending
                if (rsvpData != 403) {
                    
                    const attendingCount = await getAttendingCount();
                    store.publish({
                        type: 'event-attending-count/refresh',
                        payload: attendingCount,
                    });
                    
                    const someAttendingData = await getEventSomeAttending();
                    store.publish({
                        type: 'event-some-attending/refresh',
                        payload: someAttendingData,
                    });
                }

                //updateComments
                if (rsvpData != 403 && commentBox.value !== '') {
                    const commentData = await postNewEventComment(commentBox.value);
                    commentBox.value = '';

                    const allCommentsData = await getEventComments();
                    store.publish({
                        type: 'event-comments/refresh', 
                        payload: allCommentsData,
                    });
                }

                //close modal
                store.publish({
                    type: 'event-rsvp-prompt/hide',
                });

            });//attendbuttonclick




        //RENDER
            
            //show  prompt on state change (click on button from rsvp component)
            store.subscribe((oldState, newState) => {

                if (!_.isEqual(oldState.event_rsvp_prompt_show, newState.event_rsvp_prompt_show)) {

                    if (newState.event_rsvp_prompt_show) {
                        modalWrapper.style.display = 'block';
                        commentBox.select();
                    } else {
                        modalWrapper.style.display = 'none';
                    }//if

                }//ifstatechange
            });//


    }//
    document.addEventListener('DOMContentLoaded', RsvpPromptModal);


</script>