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

function getEventTitle() {
    const url = new URL(`${window.location.href}/get-event-title`);
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

function getEventHostedBy() {
    const url = new URL(`${window.location.href}/get-event-hosted-by`);
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

function getEventAbout() {

    const url = new URL(`${window.location.href}/get-event-about`);

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


function getEventAccess() {
    const url = new URL(`${window.location.href}/get-event-access`);
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

function getEventWhen() {
    const url = new URL(`${window.location.href}/get-event-when`);
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


function getEventLocation() {
    const url = new URL(`${window.location.href}/get-event-location`);
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

function getEventImage() {
    const url = new URL(`${window.location.href}/get-event-image`);
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

function getEventTag() {
    const url = new URL(`${window.location.href}/get-event-tag`);
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




// POST ==============================================================================================


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


    function postEventImage(newEventImage) {
                const url = new URL(`${window.location.href}/post-event-image`);
                const formData = new FormData(document.createElement('form'));
                formData.set('event_image', newEventImage);
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

    function postEventTitle(newEventTitle) {
                const url = new URL(`${window.location.href}/post-event-title`);
                const formData = new FormData(document.createElement('form'));
                formData.set('event_title', newEventTitle);
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

    function postEventAbout(newEventAbout) {
                const url = new URL(`${window.location.href}/post-event-about`);
                const formData = new FormData(document.createElement('form'));
                formData.set('event_about', newEventAbout);
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
                        return res;
                    }
                    break;                
                case 419: 
                    {
                        return res;
                    }
                    break;                
                default:
                    throw res;
                    break;
            }//switch
        })//then
    }//
    
    function postEventWhen(startDateTimeISO, endDateTimeISO) {
                const url = new URL(`${window.location.href}/post-event-when`);
                const formData = new FormData(document.createElement('form'));
                formData.set('event_start_at_ISO', startDateTimeISO);
                formData.set('event_end_at_ISO', endDateTimeISO);
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
                        return res;
                    }
                    break;                
                case 419: 
                    {
                        return res;
                    }
                    break;                
                default:
                    throw res;
                    break;
            }//switch
        })//then
    }//



</script>