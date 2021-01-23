{{--  --}}


<style>
    .event-comments-wrapper {

        padding: 1rem;

        border-left: rgba(193, 206, 223, 0.5) 1px solid;
    }

    .event-hidden-reply-form-wrapper {
        display: none;
    }

    .event-main-comment-reply-link {
        margin-left: auto;
        visibility: hidden;
        cursor: pointer;
        text-decoration: none;
    }
</style>


{{-- ------------------------------------------------------------------------------------------------ --}}



<div class="event-comments-wrapper">

    <h5>Comments</h5>

    <!-- title offset wrapper -->
    <div class="col-10 offset-1">


        <div data-js="event-comments-entry" class="event-comments-entry"></div>


        <!-- input -->
        <form data-js="event-comments-form" class="mt-5" style=" border-top:rgba(193, 206, 223, 0.5) 1px solid">
            <div class="row no-gutters my-4">

                @auth
                <div class="col-2">
                    <img class="w-75 rounded-lg" style="object-fit: cover"
                        src={{asset(Auth::user()->profile->image->first()->path)}}>
                </div>
                @endauth

                <div class="col d-flex flex-column">

                    <input data-js="event-comments-form-textarea" class="form-control" name="new-comment"
                        placeholder="Leave a new comment...">

                    <button class="btn btn-primary align-self-end mt-3" type="submit">New Comment</button>

                </div>

            </div>
        </form>


    </div><!-- end title offset wrapper -->

</div><!-- //wrapper -->


{{-- ------------------------------------------------------------------------------------------------ --}}


<script>
    function EventComments() {
    // ------------------------------------------------------------------------------------------------------




        //DOM

            const eventCommentsEntry = document.querySelector('[data-js="event-comments-entry"]');
            !eventCommentsEntry&&console.error('query selector not found');
            
            const eventCommentsForm = document.querySelector('[data-js="event-comments-form"]');
            !eventCommentsForm&&console.error('query selector not found');
            
            const eventCommentsFormTextArea = document.querySelector('[data-js="event-comments-form-textarea"]');
            !eventCommentsFormTextArea&&console.error('query selector not found');




        //EVENTS

            //on comments load
            (async function() {
                const data = await getEventComments() //endpoint
                store.publish({
                    type: 'event_comments/refresh',
                    payload: data,
                });
            })();


            //adding new comment
            eventCommentsForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (eventCommentsFormTextArea.value.length>0) {

                    //post comment
                    const newCommentText = eventCommentsFormTextArea.value;
                    await postNewEventComment(newCommentText);
                    eventCommentsFormTextArea.value = '';

                    //refresh comments
                    const data = await getEventComments() //endpoint
                    store.publish({
                        type: 'event_comments/refresh',
                        payload: data,
                    });

                }//if
            });//
            

        //RENDER FUNCTIONS


            //render COMMENTS
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_comments, newState.event_comments)) {

                    const formatedComments = newState.event_comments.map((comment) => {
                        return `
                        <div data-js="event-main-comments">
                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <a href="${comment.user_profile_path}">
                                        <img class="w-75 rounded-lg" src="${comment.user_profile_image}" alt="">
                                    </a>
                                </div>
                                <div class="col-10">
                                    <div class="rounded-lg p-3" style="background-color: rgba(193, 206, 223, 0.3)">
                                        <div class="d-flex mb-1">
                                            <a class="text-reset" href="${comment.user_profile_path}">
                                                <b class="font-weight-bold">${comment.user_name}</b>
                                            </a>
                                            <a data-js="event-main-comment-reply-link" class="event-main-comment-reply-link">
                                                Reply
                                            </a>
                                        </div>
                                        <div>
                                            ${comment.body}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <small>
                                            ${comment.created_at}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div data-js="event-hidden-reply-form-wrapper" class="event-hidden-reply-form-wrapper">
                                <div class="row no-gutters my-3">
                                    <div class="col-10 offset-2">
                                        <form class="d-flex flex-column">
                                            <input type="hidden" name="parent_id" value="${comment.id}">
                                            <input name="reply_comment" placeholder="leave a reply..." autocomplete="off" class="form-control">
                                            <button type="submit" class="btn btn-primary align-self-end mt-3">Reply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                            ${
                                comment.reply_comments.map((replyComment) => {
                                    return `
                                        <div class="row no-gutters mt-1">
                                            <div class="col-2 offset-2">
                                                <a href="${replyComment.user_profile_path}">
                                                    <img class="w-75 rounded-lg" src="${replyComment.user_profile_image}" alt="">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="rounded-lg p-3" style="background-color: rgba(193, 206, 223, 0.3)">
                                                    <div class="mb-1">
                                                        <a class="text-reset" href="${replyComment.user_profile_path}">
                                                            <b class="font-weight-bold">${replyComment.user_name}</b>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        ${replyComment.body}
                                                    </div>
                                                </div>
                                                <div class="ml-3 d-flex justify-content-end">
                                                    <small>
                                                        ${replyComment.created_at}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }).join('')
                            }
                        `;
                    });

                    eventCommentsEntry.innerHTML = formatedComments.join('');
                    

                    // POST-RENDER DOM
                    const eventMainComments = document.querySelectorAll('[data-js="event-main-comments"]');
                    !eventMainComments&&console.error('dom query not found');

                    // FOR EACH MAIN COMMENT
                    eventMainComments.forEach((mainComment) => {

                        const mainCommentReplyLink = mainComment.querySelector('[data-js="event-main-comment-reply-link"]')
                        const mainCommentHiddenFormWrapper = mainComment.querySelector('[data-js="event-hidden-reply-form-wrapper"]')
                        const mainCommentHiddenForm = mainCommentHiddenFormWrapper.querySelector('form');
                        
                        //show and hide reply link button on hover
                        mainComment.addEventListener('mouseover', (e) => {
                            mainCommentReplyLink.style.visibility = 'visible';
                        });
                        mainComment.addEventListener('mouseout', (e) => {
                            mainCommentReplyLink.style.visibility = 'hidden';
                        });

                        //show and focus hidden reply form
                        mainCommentReplyLink.addEventListener('click', (e) => {
                            e.preventDefault();
                            if (mainCommentHiddenFormWrapper.style.display == 'block') {
                                mainCommentHiddenFormWrapper.style.display = 'none'
                            } else {
                                mainCommentHiddenFormWrapper.style.display = 'block';
                                mainCommentHiddenForm.elements['reply_comment'].focus();
                            }
                        });

                        //add replies to a main comment
                        mainCommentHiddenForm.addEventListener('submit', async (e) => {
                            e.preventDefault();

                            const mainCommentId = mainCommentHiddenForm.elements['parent_id'].value;
                            const newReplyCommentText = mainCommentHiddenForm.elements['reply_comment'].value;

                            await postNewEventReplyComment(mainCommentId, newReplyCommentText)

                            //no clean up needed when all comments re-rendered
                            const data = await getEventComments() //endpoint
                            store.publish({
                                type: 'event_comments/refresh',
                                payload: data,
                            });

                        });//replySubmit


                    });//eventMainComments.foreach()

                }//if state change
            });//store.subscribe()








    // ------------------------------------------------------------------------------------------------------
    }//EventComments() 
    document.addEventListener('DOMContentLoaded', EventComments);
</script>