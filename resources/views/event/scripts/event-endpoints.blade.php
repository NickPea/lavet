{{--  --}}

<script>



function getEventComments() {
    let url = new URL(`${window.location.href}/get-event-comments`);

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

    let url = new URL(`${window.location.href}/get-event-attending-all-attendees`);

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
                    res.json()
                    .then((data) => {
                        console.log('New Comment Created');
                    })
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
                    res.json()
                    .then((data) => {
                        console.log('New Reply Comment Created');
                    })
                }
                break;
            default:
                throw res;
                break;
        }//switch
    })//then
}//





</script>