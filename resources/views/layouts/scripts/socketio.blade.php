{{--  --}}
@auth
<script>
    'use strict'

    function WebSockets() {
        
            let userEmailHash = '<?php echo hash(hash_algos()[5], Auth::user()->email??'')?>'; //SHA-256
            //todo: store in database user table on registration
            
            window.socket = io('http://localhost:5000');
            
            socket.on('connect', () => {
                socket.emit('map-socket-user', {userEmailHash: userEmailHash});
                console.error(`-- CONNECTED: mapping user & socket -- \n userEmailHash: ${userEmailHash}, socket.id: ${socket.id}`);
            });
            
            window.addEventListener('beforeunload', () => {
                socket.emit('unmap-socket-user', {userEmailHash: userEmailHash});
            });
            
            socket.on('disconnect', (reason) => {
                console.error(`-- DISCONNECTED -- ${reason} \n userEmailHash: ${socket.userEmailHash}, socket: ${socket.id},`);
            });
            
            socket.on('FROM-NODE-TO-BROWSER', async (data) => {

                switch (data.action) {
                        case 'sidechat/new-message' :
                            {
                                //if relevent conversation open in messenger update/refresh the conversation
                                if(chatStore.getState().messenger_conversation_id == data.payload.conversation_id) {
                                    //TODO: overide below endpoint to accept just the message header id perhaps
                                    let tempForm = document.createElement('form');
                                    tempForm.insertAdjacentHTML('afterbegin', `<input name="message_header_id" value="${data.payload.conversation_id}">`);
                                    tempForm.insertAdjacentHTML('afterbegin', `@csrf`);
                                    sideChatRefreshMessenger(tempForm);
                                } 

                                //update conversation and total unread counts regardless
                                sideChatRefreshConversations();
                                sideChatRefreshTotalUnreadCount();

                            }
                        break;
                        case 'sidechat/read-messages' :
                            {
                                //if relevent conversation open in messenger update/refresh message to show that they have been read
                                if(chatStore.getState().messenger_conversation_id == data.payload.conversation_id) {
                                    // TODO: overide below endpoint to accept just the message header id perhaps
                                    let tempForm = document.createElement('form');
                                    tempForm.insertAdjacentHTML('afterbegin', `<input name="message_header_id" value="${data.payload.conversation_id}">`);
                                    tempForm.insertAdjacentHTML('afterbegin', `@csrf`);
                                    sideChatRefreshMessenger(tempForm);                                
                                }
                            }
                        break;
                        case 'sidechat/started-typing' :
                            {
                                chatStore.publish({
                                    type: 'currently-typing/add-conversation',
                                    payload: data.payload.name,
                                });

                                //remove after timeout just in case user never stops typing
                                setTimeout(() => {
                                        console.error('currently typing timed-out');
                                        chatStore.publish({
                                            type: 'currently-typing/remove-conversation',
                                            payload: data.payload.name,
                                        });
                                }, 3000);
                            }
                        break;
                        case 'sidechat/stopped-typing' :
                            {
                                chatStore.publish({
                                    type: 'currently-typing/remove-conversation',
                                    payload: data.payload.name,
                                });
                            }
                        break;
                    default:
                        break;
                }//sw
                    
            });
            
        }
        document.addEventListener('DOMContentLoaded', WebSockets);
        
        
</script>
@endauth