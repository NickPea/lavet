{{--  --}}



<script>
    'use strict'

    function sideChatMarkConversationMessagesAsRead(form) {
        let url = new URL(`${window.location.origin}/sidechat/mark-conversation-messages-as-read`);
        let formData = new FormData(form);

        return fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then((res) => {
                switch (res.status) {
                    case 201 :
                        {
                            res.json().then((data) => {
                                console.log(`Marked Messages`);
                                console.log(data);
                            });
                        }
                        break;
                    default:
                        throw res
                        break;
                }
            })
            .catch((res) => {console.error(res);});

        
    }//

    function sideChatRefreshTotalUnreadCount() {
        let url = new URL(`${window.location.origin}/sidechat/refresh-total-unread-count`);
        return fetch(url)
            .then((data) => data.json())
            .then((data) => {
                chatStore.publish({
                    type: 'total-unread-count/refresh',
                    payload: data.total_unread_count,
                })//publish
            })//then
        
    }//

    function sideChatRefreshConversations() {
        let url = new URL(`${window.location.origin}/sidechat/refresh-conversations`);
        return fetch(url)
            .then((data) => data.json())
            .then((conversations) => {
                chatStore.publish({
                    type: 'conversations/refresh',
                    payload: conversations
                })//publish
            })//then
        
    }//

    function sideChatRefreshMessenger(form) {
        let url = new URL(`${window.location.origin}/sidechat/refresh-messenger`);
        let formData = new FormData(form)

        return fetch(url, {
            method: 'POST', 
            body: formData,
            })
            .then((data) => data.json())
            .then((messages) => {
                
                chatStore.publish({
                    type: 'messenger/refresh-messages',
                    payload: messages
                });

                chatStore.publish({
                    type: 'messenger/refresh-conversation-id',
                    payload: formData.get('message_header_id')
                });

            })//then
    }//

    function sideChatSendMessage(form) {
        let url = new URL(`${window.location.origin}/sidechat/send-message`);
        let data = new FormData(form)

        return fetch(url, {
            method: 'POST', 
            body: data,
            })
            .then((res) => {
                switch (res.status) {
                    case 201 :
                        {
                            res.json().then((data) => {
                                    console.log(`Message Created:`);
                                    console.log(data);
                                });
                            break;
                        }
                    default:
                        {
                            throw res;
                            break;
                        }
                }//sw
            })
            .catch((res) => {console.error(res);});
              
    }//

    function sideChatSendStartedTypingHint(form) {
        const url = new URL(`${window.location.origin}/sidechat/send-started-typing-hint`);
        const formData = new FormData(form);
        return fetch(url, {
            method: 'POST',
            body: formData
        })
        .then((res) => {
            switch (res.status) {
                case 204 :
                    console.error('started typing');
                    break;
                default:
                    throw res;
                    break;
            }
        })
    }//

    function sideChatSendStoppedTypingHint(form) {
        const url = new URL(`${window.location.origin}/sidechat/send-stopped-typing-hint`);
        const formData = new FormData(form);
        return fetch(url, {
            method: 'POST',
            body: formData
        })
        .then((res) => {
            switch (res.status) {
                case 204 :
                    console.error('stopped typing');
                    break;
                default:
                    throw res;
                    break;
            }
        })
    }//
    
    function sideChatAddConversationFromProfileId(profileId) {

        const url = new URL(`${window.location.origin}/sidechat/add-conversation-from-profile-id`);

        const formData = new FormData(document.createElement('form'));
        formData.set('profile_id', profileId)
        formData.set('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));


        return fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then((res) => {
            switch (res.status) {
                case 201 :
                        return res.json()
                        .then((data) => {
                                console.log('Conversation Created:')
                                console.log(data);
                                return data;
                            })
                    break;
                case 202 :
                        return res.json()
                        .then((data) => {
                                console.log('Conversation Already Exists:')
                                console.log(data); 
                                return data
                            })
                    break;
                default:
                    throw res;
                    break;
            }
        })
    }//



    


</script>