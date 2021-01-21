{{--  --}}


<style>
    /* open button */

    .side-chat-open-button {
        position: fixed;
        right: 3vw;
        top: 5vh;
        z-index: 999999999999999999999;

        padding: 0.7rem;
        background: whitesmoke;
        border: 1px solid grey;
        border-radius: 50%;
    }

    .side-chat-open-button-currently-typing-hint {
        display: none;
        position: absolute;

        z-index: -1;

        top: -7.5px;
        left: -7.5px;

        height: 30px;
        width: 30px;

        border-radius: 50%;
        background-color: orange;

        animation: open-button-currently-typing-hint 1s ease infinite;
    }

    @keyframes open-button-currently-typing-hint {
        0% {
            transform: scale(0)
        }

        100% {}

    }

    .side-chat-open-button-unread-count {

        display: none;
        /* if has messages then d-flex*/

        position: absolute;
        top: -5px;
        left: -5px;

        height: 25px;
        width: 25px;

        overflow: hidden;
        border-radius: 50%;

        justify-content: center;
        align-items: center;

        padding: 0.1rem;
        background-color: orange;
    }


    /* side-chat-wrappers */

    .side-chat-position {
        position: fixed;
        right: 0;
        top: 0;
    }

    .side-chat-variables {
        --header: white;
        --contacts: whitesmoke;
        --messenger: whitesmoke;
        --footer: white;
        --close: grey;
        --shadow1: 0 0 3px 3px darkgrey;
    }

    .side-chat-transition {
        transition: width 200ms ease;
    }

    /* side-chat */

    .side-chat {
        height: 100%;
        width: 0vw;
        /*closed on page load*/

        z-index: 99999999999;
        overflow: hidden;

        box-shadow: var(--shadow1)
    }

    .side-chat-open {
        width: 50vw;
    }

    @media screen and (max-width: 1000px) {
        .side-chat-open {
            width: 80vw;
        }
    }

    /* header */

    .side-chat-header {
        height: 5%;
        width: 100%;

        background-color: var(--header);
        border-bottom: 1px solid black;

        display: flex;
        flex-flow: nowrap;

    }

    /* close button */

    .side-chat-header-close-button {
        align-self: center;
        padding: 0.5rem;
    }

    .side-chat-header-hint-message {
        align-self: center;
    }

    /* body */

    .side-chat-body {
        height: 90%;
        width: 100%;

        display: flex;
        flex-flow: row nowrap;
    }

    /* left panel */

    .side-chat-body-left-panel {
        flex: 50%;
        /* of body flex row width */
        height: 100%;
        /* of body 90% */
        background-color: var(--messenger);

        display: flex;
        flex-flow: column nowrap;
    }

    /* messages */

    .side-chat-body-left-panel-messages {
        height: 90%;
        /* of left panel */

        background-color: white;
        padding: 1rem 1rem 0 1rem;

        overflow-y: auto;
        scroll-behavior:auto;

        display: flex;
        flex-flow: column nowrap;
    }

    .side-chat-body-right-panel-messages-user-wrapper {
        width: 100%;

        margin-bottom: 2px;

        display: flex;
        flex-flow: column nowrap;
        align-items: flex-end;
    }

    .side-chat-body-right-panel-messages-non-user-wrapper {
        width: 100%;

        margin-bottom: 2px;

        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
    }

    .side-chat-body-right-panel-messages-user-body {
        max-width: 75%;

        position: relative;

        padding: 0.7rem;
        background-color: rgb(61, 61, 180);
        border-radius: 1rem 1rem 0 1rem;
        color: white;

        font-size: 1.05rem;

        word-break: break-word;

    }

    .side-chat-body-right-panel-messages-non-user-body {
        max-width: 75%;

        position: relative;

        padding: 0.7rem;
        background-color: rgb(180, 180, 180);
        border-radius: 1rem 1rem 1rem 0;
        color: black;

        font-size: 1.05rem;

        word-break: break-word;
    }

    .side-chat-body-left-panel-messages-created-at {
        visibility: hidden;

        color: grey;
        font-size: 0.8rem;
    }

    .side-chat-body-right-panel-messages-user-wrapper:hover .side-chat-body-left-panel-messages-created-at {
        visibility: visible;
    }

    .side-chat-body-right-panel-messages-non-user-wrapper:hover .side-chat-body-left-panel-messages-created-at {
        visibility: visible;
    }

    .side-chat-body-left-panel-messages-user-read-at {
        position: absolute;
        bottom: 0;
        left: 0;

        height: 9px;
        width: 9px;
        background-color: green;
        border: 1px solid white;
        border-radius: 50%;

    }

    .side-chat-body-left-panel-messages-non-user-read-at {
        position: absolute;
        bottom: 0;
        right: 0;

        height: 9px;
        width: 9px;
        background-color: green;
        border: 1px solid white;
        border-radius: 50%;

    }




    /* input */

    .side-chat-body-left-panel-form {
        height: 10%;
        /* of left panel */
    }

    .side-chat-body-left-panel-input {
        height: 100%;
        /* of left panel form */
        width: 100%;

        padding: 1rem;
        letter-spacing: 2px;
        font-size: 1rem;

        border: none;
        background-color: rgb(221, 221, 221);
    }

    .side-chat-body-left-panel-input:hover {
        background-color: rgb(199, 199, 199);
    }

    .side-chat-body-left-panel-input:focus {
        outline: none;
        /* background-color: rgb(110, 110, 110); */
        /* color: white */
    }

    /* right panel */

    .side-chat-body-right-panel {
        flex: 50%;
        /* of body flex row width */
        height: 100%;
        /* of body 90% */
        background-color: var(--contacts);
        overflow-y: auto;
        border-left: 1px solid darkgrey;
    }

    /* conversations */

    .side-chat-body-right-panel-conversation {
        display: flex;
        flex-flow: nowrap;
        align-items: center;
        align-content: center;

        padding: 7px;
        margin: 3px 1rem;
        border-radius: 0.5rem;

        cursor: pointer;
    }

    .side-chat-body-right-panel-conversation:hover {
        background-color: white;
    }

    .side-chat-body-right-panel-conversation-selected {
        background-color: lightgrey
    }

    .side-chat-body-right-panel-conversation-selected:hover {
        background-color: lightgrey;
    }



    .side-chat-body-right-panel-conversation-overlay {
        position: relative;

        margin-right: 1rem;
    }

    .side-chat-body-right-panel-conversation-img {
        flex-shrink: 0;

        width: 40px;
        height: 40px;
        border: 1px solid lightgrey;
        border-radius: 50%;
        object-fit: cover;

    }

    .side-chat-body-right-panel-conversation-offline-badge {
        position: absolute;
        top: 0;
        left: 0;

        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: grey;
        border: 1px solid white;
    }

    .side-chat-body-right-panel-conversation-online-badge {
        position: absolute;
        top: 0;
        left: 0;

        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: green;
        border: 1px solid white;
        animation: online-badge-pulse 2.5s infinite;
    }

    @keyframes online-badge-pulse {
        0% {
            box-shadow: 0 0 1px 1px white;
        }

        50% {
            box-shadow: 0 0 3px 1px green;
        }

        100% {
            box-shadow: 0 0 1px 1px white;
        }
    }

    .side-chat-body-right-panel-conversation-unread-badge {
        position: absolute;
        bottom: -5px;
        right: -5px;

        display: flex;
        justify-content: center;
        align-items: center;

        width: 20px;
        height: 20px;

        padding: 0.1rem;
        border-radius: 50%;

        overflow: hidden;

        color: white;
        background-color: orange;
    }


    .side-chat-body-right-panel-conversation-name {
        font-weight: bolder;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* footer */

    .side-chat-footer {
        height: 5%;
        background-color: var(--footer);
        border-top: 1px solid black;

    }


    /* utility */

    .side-chat-button:hover {
        box-shadow: var(--shadow1);
    }

    .side-chat-button:active {
        box-shadow: none;
        transform: scale(0.9, 0.9);
    }
</style>



{{-- ------------------------------------------------------------------------------------ --}}


<!-- open button -->
<div class="side-chat-open-button side-chat-button side-chat-variables" data-js="side-chat-open-button">
    @include('svg.chat')
    <span class="side-chat-open-button-unread-count" data-js="side-chat-open-button-unread-count"></span>
    <span class="side-chat-open-button-currently-typing-hint"
        data-js="side-chat-open-button-currently-typing-hint"></span>
</div>


<!-- side chat -->
<div class="side-chat side-chat-position side-chat-transition side-chat-variables" data-js="side-chat-main">


    <!-- header -->
    <div class="side-chat-header">
        <div class="side-chat-header-close-button side-chat-button" data-js="side-chat-header-close-button">
            @include('svg.arrow-right')
        </div>

        <span class="side-chat-header-hint-message" data-js="side-chat-header-hint-message"></span>

    </div>


    <!-- body -->
    <div class="side-chat-body">

        <!-- messenger -->
        <div class="side-chat-body-left-panel">

            <!-- chat messages -->
            <div class="side-chat-body-left-panel-messages" data-js="side-chat-body-left-panel-messages"></div>

            <!-- text input -->
            <form class="side-chat-body-left-panel-form" data-js="side-chat-body-left-panel-form">
                <input class="side-chat-body-left-panel-input" name="chat_message"
                    data-js="side-chat-body-left-panel-input" placeholder="Aa..." autocomplete="off">
                <input data-js="side-chat-body-left-panel-hidden-input" type="hidden" name="message_header_id">
                @csrf
            </form>

        </div>

        <!-- contacts -->
        <div class="side-chat-body-right-panel" data-js="side-chat-body-right-panel"></div>

    </div>


    <!-- footer -->
    <div class="side-chat-footer"></div>


</div>



{{-- ------------------------------------------------------------------------------------ --}}



<script>
    function SideChat() {

        'use strict'
        
        //DOM
        let sideChatOpenButton = document.querySelector('[data-js="side-chat-open-button"]');
        !sideChatOpenButton&&console.error('query selector not found');
        
        let sideChatOpenButtonUnreadCount = document.querySelector('[data-js="side-chat-open-button-unread-count"]');
        !sideChatOpenButtonUnreadCount&&console.error('query selector not found');
        
        let sideChatCloseButton = document.querySelector('[data-js="side-chat-header-close-button"]');
        !sideChatOpenButton&&console.error('query selector not found');
        
        let sideChatMain = document.querySelector('[data-js="side-chat-main"]');
        !sideChatMain&&console.error('query selector not found');
        
        let sideChatBodyContacts = document.querySelector('[data-js="side-chat-body-right-panel"]');
        !sideChatBodyContacts&&console.error('query selector not found');
       
        let sideChatBodyMessengerForm = document.querySelector('[data-js="side-chat-body-left-panel-form"]');
        !sideChatBodyMessengerForm&&console.error('query selector not found');
       
        let sideChatBodyMessengerInput = document.querySelector('[data-js="side-chat-body-left-panel-input"]');
        !sideChatBodyMessengerInput&&console.error('query selector not found');
       
        let sideChatBodyMessengerHiddenInput = document.querySelector('[data-js="side-chat-body-left-panel-hidden-input"]');
        !sideChatBodyMessengerHiddenInput&&console.error('query selector not found');
        
        let sideChatBodyMessengerMessages = document.querySelector('[data-js="side-chat-body-left-panel-messages"]');
        !sideChatBodyMessengerMessages&&console.error('query selector not found');
        
        let sideChatHeaderHintMessage = document.querySelector('[data-js="side-chat-header-hint-message"]');
        !sideChatHeaderHintMessage&&console.error('query selector not found');
        
        let sideChatOpenButtonCurrentlyTypingHint = document.querySelector('[data-js="side-chat-open-button-currently-typing-hint"]');
        !sideChatOpenButtonCurrentlyTypingHint&&console.error('query selector not found');
        

        //EVENTS

        //called on script load, get total unread count
        sideChatRefreshTotalUnreadCount();




        //open messenger
        sideChatOpenButton.addEventListener('click', (e) => {
            chatStore.publish({type: 'messenger/open'});
        });
       
        //close messenger
        sideChatCloseButton.addEventListener('click', (e) => {
            chatStore.publish({type: 'messenger/close'});
        });

        //focus input on message section click
        sideChatBodyMessengerMessages.addEventListener('click', () => {
            sideChatBodyMessengerInput.focus();
        });

        //send/submit new messsage
        sideChatBodyMessengerForm.addEventListener('submit', async () => {
            event.preventDefault();

            await sideChatSendMessage(sideChatBodyMessengerForm);
            sideChatRefreshMessenger(sideChatBodyMessengerForm);

            //could potential delete after adding marked read_at func..
            sideChatRefreshConversations();

            sideChatBodyMessengerInput.value = "";

        })

        //mark messages as read on messenger input focus
        sideChatBodyMessengerInput.addEventListener('focus', async (e) => {
            
            const tempForm = document.createElement('form');
            tempForm.insertAdjacentHTML('afterbegin', `<input name="message_header_id" value="${chatStore.getState().messenger_conversation_id}">`);
            tempForm.insertAdjacentHTML('afterbegin', `@csrf`);

            await sideChatMarkConversationMessagesAsRead(tempForm)
            await sideChatRefreshMessenger(tempForm);
            sideChatRefreshConversations();
            sideChatRefreshTotalUnreadCount();
        });

        // send typing hints to recipient
        {
            let previousInputCharLength = 0; //start off with an empty input
            
            sideChatBodyMessengerInput.addEventListener('input', async (e) => {
                
                const currentConversationId = chatStore.getState().messenger_conversation_id
                const currentInputCharLength = [...e.target.value].length;

                //if input empty then i've stopped typing, send 'stopped' hint
                if (currentInputCharLength == 0) {
                    sideChatSendStoppedTypingHint(sideChatBodyMessengerForm)
                }
                
                //if input not empty AND i just started typing send 'started' hint, 
                if (currentInputCharLength > 0 && previousInputCharLength == 0) {
                    sideChatSendStartedTypingHint(sideChatBodyMessengerForm)
                }
                
                previousInputCharLength = currentInputCharLength; //set for next input event
            });

            // reset previous length to 0 on input form submit
            sideChatBodyMessengerForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                sideChatSendStoppedTypingHint(sideChatBodyMessengerForm);
                previousInputCharLength = 0;
            });

        }//end type hinting block scope





        //RENDER


        //render MESSENGER-OPEN
        chatStore.subscribe((oldState, newState) => {
            if (!_.isEqual(oldState.messenger_open, newState.messenger_open)) {

                if (newState.messenger_open) {
                    sideChatMain.classList.add('side-chat-open')
                    sideChatOpenButton.style.display = "none";
                    sideChatRefreshConversations();
                } else {
                    sideChatMain.classList.remove('side-chat-open')
                    sideChatOpenButton.style.display = "block";
                }

            }//if state change
        });
                


        //render TOTAL-UNREAD-MESSAGES
        chatStore.subscribe((oldState, newState) => {
            if (!_.isEqual(oldState.total_unread_count, newState.total_unread_count)) {
                
                if (newState.total_unread_count > 0) {
                    sideChatOpenButtonUnreadCount.style.display = 'flex';
                    sideChatOpenButtonUnreadCount.textContent = newState.total_unread_count;
                } else {
                    sideChatOpenButtonUnreadCount.style.display = 'none';
                    sideChatOpenButtonUnreadCount.textContent = '';
                }
            }
        });

        //render CONVERSATIONS
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.conversations, newState.conversations)) {

                let chatConversations = 
                    newState.conversations.map((conversationData) => {


                        let eachConversation = '';

                            eachConversation = `
                            <div class="side-chat-body-right-panel-conversation ${newState.messenger_conversation_id == conversationData.message_header_id ? 'side-chat-body-right-panel-conversation-selected' : ''}"
                                            data-js="side-chat-body-right-panel-conversation">
                                        <span class="side-chat-body-right-panel-conversation-overlay">
                                            <img class="side-chat-body-right-panel-conversation-img" src="${conversationData.image}">
                                            ${
                                                conversationData.unread_count > 0
                                                    ? `<span class="side-chat-body-right-panel-conversation-unread-badge">${conversationData.unread_count}</span>` 
                                                    : ''
                                            }
                                            ${
                                                conversationData.is_online
                                                    ? '<span class="side-chat-body-right-panel-conversation-online-badge"></span>'
                                                    : '<span class="side-chat-body-right-panel-conversation-offline-badge"></span>'
                                            }
                                        </span>
                                        <span class="side-chat-body-right-panel-conversation-name">${conversationData.name}</span>
                                        <form>
                                            <input type="hidden" name="message_header_id" value="${conversationData.message_header_id}">
                                            @csrf 
                                        </form>
                                    </div>
                                    `;

                        return eachConversation;

                    });
                sideChatBodyContacts.innerHTML = chatConversations.join('');

                //rendered EVENTS
                let allDomConversations = document.querySelectorAll('[data-js="side-chat-body-right-panel-conversation"]');
                allDomConversations.length==0&&console.error('query selector not found', allDomConversations);
                
                //each conversation
                allDomConversations.forEach((dOMConversation) => {
                    
                    //conversation on click
                    dOMConversation.addEventListener('click', async (e) => {

                        let conversationHiddenForm = dOMConversation.querySelector('form');

                        await sideChatMarkConversationMessagesAsRead(conversationHiddenForm);
                        await sideChatRefreshMessenger(conversationHiddenForm);
                        await sideChatRefreshConversations();
                        await sideChatRefreshTotalUnreadCount();


                        sideChatBodyMessengerMessages.scrollTo(0, sideChatBodyMessengerMessages.scrollHeight);
                        sideChatBodyMessengerInput.focus();
                        sideChatBodyMessengerInput.value = "";
                    });


                });//each


            }//if state change
        })//

        //render

        //render MESSAGES
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.messenger_messages, newState.messenger_messages)) {

                let messages = newState.messenger_messages.map((chat) => {
                    const isUser = <?php echo Auth::user()?Auth::user()->id:''?> == chat.user.id;
                    const chatCreatedAt = window.moment(chat.created_at).fromNow();
                    const chatReadAt = window.moment.utc(chat.read_at).fromNow();
                    
                    return isUser
                            //user message
                            ? `
                            <span class="side-chat-body-right-panel-messages-user-wrapper">
                                <span class="side-chat-body-right-panel-messages-user-body">
                                    ${chat.body}
                                    ${
                                        chat.read_at != null
                                            ? '<span class="side-chat-body-left-panel-messages-user-read-at"></span>'
                                            : ''
                                    }
                                </span>
                                ${
                                    chat.read_at != null
                                        ? `<span class="side-chat-body-left-panel-messages-created-at">${'seen '+ chatReadAt}</span>`
                                        : `<span class="side-chat-body-left-panel-messages-created-at">${'sent '+ chatCreatedAt}</span>`
                                }
                            </span>
                            `
                            //non-user message
                            : `
                            <span class="side-chat-body-right-panel-messages-non-user-wrapper">
                                <span class="side-chat-body-right-panel-messages-non-user-body">
                                    ${chat.body}
                                    ${
                                        chat.read_at != null
                                            ? '<span class="side-chat-body-left-panel-messages-non-user-read-at"></span>'
                                            : ''
                                    }
                                </span>
                                ${
                                    chat.read_at != null
                                        ? `<span class="side-chat-body-left-panel-messages-created-at">${'seen '+ chatReadAt}</span>`
                                        : `<span class="side-chat-body-left-panel-messages-created-at">${'sent '+ chatCreatedAt}</span>`
                                }
                            </span>
                            `;
                });

                sideChatBodyMessengerMessages.innerHTML = messages.join('');
                sideChatBodyMessengerMessages.scrollTo(0, sideChatBodyMessengerMessages.scrollHeight);

            }//if state change
        });//sub


        // render Typing Hints
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.currently_typing, newState.currently_typing)) {

                const currentlyTypingNames = chatStore.getState().currently_typing;
               
                if (newState.currently_typing.length !== 0) {
                    
                    sideChatHeaderHintMessage.textContent = `${currentlyTypingNames.join(', ')} is typing`;
                    sideChatOpenButtonCurrentlyTypingHint.style.display = 'block';

                } else {
                    sideChatHeaderHintMessage.textContent = '';
                    sideChatOpenButtonCurrentlyTypingHint.style.display = 'none';

                }

            }//if state change
        });//



        //render CONVERSATION-ID (into hidden input of the send message form)
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.messenger_conversation_id, newState.messenger_conversation_id)) {

                sideChatBodyMessengerHiddenInput.value = newState.messenger_conversation_id;

                ///FORCE CONVERSTAION RE-RENDER (TERRIBLE REUSE OF CODE)
                let chatConversations = 
                    newState.conversations.map((conversationData) => {


                        let eachConversation = '';

                            eachConversation = `
                                    <div class="side-chat-body-right-panel-conversation ${newState.messenger_conversation_id == conversationData.message_header_id ? 'side-chat-body-right-panel-conversation-selected' : ''}"
                                            data-js="side-chat-body-right-panel-conversation">
                                        <span class="side-chat-body-right-panel-conversation-overlay">
                                            <img class="side-chat-body-right-panel-conversation-img" src="${conversationData.image}">
                                            ${
                                                conversationData.unread_count > 0
                                                    ? `<span class="side-chat-body-right-panel-conversation-unread-badge">${conversationData.unread_count}</span>` 
                                                    : ''
                                            }
                                            ${
                                                conversationData.is_online
                                                    ? '<span class="side-chat-body-right-panel-conversation-online-badge"></span>'
                                                    : '<span class="side-chat-body-right-panel-conversation-offline-badge"></span>'
                                            }
                                        </span>
                                        <span class="side-chat-body-right-panel-conversation-name">${conversationData.name}</span>
                                        <form>
                                            <input type="hidden" name="message_header_id" value="${conversationData.message_header_id}">
                                            @csrf 
                                        </form>
                                    </div>
                                    `;

                        return eachConversation;

                    });
                sideChatBodyContacts.innerHTML = chatConversations.join('');

                //rendered EVENTS
                let allDomConversations = document.querySelectorAll('[data-js="side-chat-body-right-panel-conversation"]');
                allDomConversations.length==0&&console.error('query selector not found', allDomConversations);
                
                //each conversation
                allDomConversations.forEach((dOMConversation) => {
                    
                    //conversation on click
                    dOMConversation.addEventListener('click', async (e) => {

                        let conversationHiddenForm = dOMConversation.querySelector('form');

                        await sideChatMarkConversationMessagesAsRead(conversationHiddenForm);
                        await sideChatRefreshMessenger(conversationHiddenForm);
                        await sideChatRefreshConversations();
                        await sideChatRefreshTotalUnreadCount();


                        sideChatBodyMessengerMessages.scrollTo(0, sideChatBodyMessengerMessages.scrollHeight);
                        sideChatBodyMessengerInput.focus();
                        sideChatBodyMessengerInput.value = "";
                    });


                });//each

            }//if state change
        });//








    }//
    document.addEventListener('DOMContentLoaded', SideChat);

    // TASK LIST
    
      //SETUP UP SOCKETS - TICK
     
      //SHOW HINT FOR UNREAD MESSAGES FOR EACH CONVERSATION IN CONTACT LIST - TICK
     
      //SHOW HINT FOR TOTAL UNREAD MESSAGES ON SIDECHAT BUTTON - TICK
      
      //ADD SOCKET UPDATE FOR TOTAL UNREAD MESSAGES - TICK
     
      //MARK MESSAGES AS READ (on conversationa click and input click) - TICK
       
      //SHOW ONLINE STATUS IS CONVERSATION ICON - TICK 
      
      //MAKE ONLINE STATUS PULSE - TICK
      
      //SHOW CREATED AT AND SEEN TEXT UNDER MESSAGE - TICK
      
      //SHOW MESSAGES AS READ (currently as green dot) - TICK 
      
      //SOCKET UPDATE TO RECIPIENT READ MESSAGES - TICK
      
      //SHOW 'IS TYPING' HINT  - TICK (no sound yet though)
     
      //BE ABLE TO ADD A NEW USER -FROM THEIR PROFILE PAGE (CREATE A MESSAGE HEADER ASSUMING DOESNT ALREADY EXIST) - TICK
          
     
</script>