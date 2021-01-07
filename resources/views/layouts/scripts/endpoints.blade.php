{{--  --}}



<script>
    'use strict'

    function sideChatRefreshTotalUnreadCount() {
        let url = new URL(`${window.location.origin}/sidechat/refresh-total-unread-count`);
        fetch(url)
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
        fetch(url)
            .then((data) => data.json())
            .then((conversations) => {
                chatStore.publish({
                    type: 'conversations/refresh',
                    payload: conversations
                })//publish
            })//then
        
    }//

    //TODO::WHY AM I POSTING DATA HERE!????

    function sideChatRefreshMessenger(form) {
        let url = new URL(`${window.location.origin}/sidechat/refresh-messenger`);
        let formData = new FormData(form)

        fetch(url, {
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
                            res.json().then((data) => {console.log(`Message Created: ${data}`)});
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


</script>