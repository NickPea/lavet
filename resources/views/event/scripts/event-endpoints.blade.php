{{--  --}}

<script>

function getEventComments() {
    
    const url = new URL(`${window.location.href}/get-event-comments`);

    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                        });
                }
            break;
            case 403:
                {
                    return res.status;
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//


function getAttendingCount() {

    const url = new URL(`${window.location.href}/get-event-attending-count`);

    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                    })
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//

function getEventSomeAttending() {

    const url = new URL(`${window.location.href}/get-event-some-attending`);

    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                    })
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//


function getEventAttendingAllAttendess() {

    const url = new URL(`${window.location.href}/get-event-attending-all-attendees`);

    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                {
                    return res.json()
                    .then((data) => {
                        return data;
                    })
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//



function postNewEventComment(newCommentText) {

    const url = new URL(`${window.location.href}/new-event-comment`);

    const formData = new FormData(document.createElement('form'));
    formData.set('new_comment', newCommentText);
    formData.set('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));


    return fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => {
        switch (res.status) {
            case 201 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                        })
                }
            break;
            case 403:
                {
                    return res.status;
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//



function postNewEventReplyComment(mainCommentId, newReplyCommentText) {

    const url = new URL(`${window.location.href}/new-event-reply-comment`);

    const formData = new FormData(document.createElement('form'));
    formData.set('main_comment_id', mainCommentId);
    formData.set('new_reply_comment', newReplyCommentText);
    formData.set('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));


    return fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => {
        switch (res.status) {
            case 201 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                        })
                }
            break;
            case 403:
                {
                    return res.status;
                }
            break;
            default:
                throw res;
            break;
        }//switch
    })//then
}//


function postRsvpToEvent(eventStatusString) {

    const url = new URL(`${window.location.href}/post-rsvp-to-event`);
    
    const formData = new FormData(document.createElement('form'));
    formData.set('event_status', eventStatusString);
    formData.set('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));


    return fetch(url, {
        method: 'POST',
        body: formData,
    })
    .then(res => {
        switch (res.status) {
            case 201 :
                {
                    return res.json()
                        .then((data) => {
                            return data;
                        })
                }
                break;
            case 403:
                {
                    return res.status;
                }
                break;
            default:
                throw res;
                break;
        }//switch
    })//then
    }//





</script>