{{--  --}}


<style>
    /* wrappers */

    .side-chat-position {
        position: fixed;
        right: 0;
    }

    .side-chat-variables {
        --header: white;
        --contacts: whitesmoke;
        --messenger: whitesmoke;
        --footer: white;
        --close: grey;
        --shadow1: 0 0 3px 3px darkgrey;
    }

    /* side-chat */

    .side-chat {
        height: 100%;
        width: 0vw; /*closed on page load*/

        z-index: 9999999999999999;
        overflow: hidden;

        box-shadow: var(--shadow1)
    }

    .side-chat-open {
        width: 50vw;
    }

    .side-chat-transition {
        transition: width 200ms ease;
    }

    /* header */

    .side-chat-header {
        height: 5%;

        background-color: var(--header);
        border-bottom: 1px solid black;

        display: flex;
        flex-flow: nowrap;

    }

    /* close button */

    .side-chat-close-button {
        align-self: center;
        padding: 0.5rem;


    }

    /* body */

    .side-chat-body {
        height: 90%;
        display: flex;
        flex-flow: row nowrap;
    }

    .side-chat-body-messenger {
        flex: 60%;
        height: 100%;
        background-color: var(--messenger);

        display: flex;
        flex-flow: column nowrap;

    }

    .side-chat-body-messenger-messages {
        height: 90%;

        background-color: white;
        padding: 1rem;

        overflow-y: auto;
        /* scroll-behavior: smooth; */

        display: flex;
        flex-flow: column nowrap;
    }

    .side-chat-body-messenger-form {
        height: 10%;
    }

    .side-chat-body-messenger-input {
        height: 100%;
        width: 100%;
        padding: 1rem;
        letter-spacing: 2px;
        font-size: 1rem;
        border: none;
        background-color: rgb(221, 221, 221);
    }

    .side-chat-body-messenger-input:hover {
        background-color: rgb(199, 199, 199);
    }

    .side-chat-body-messenger-input:focus {
        outline: none;
        background-color: rgb(110, 110, 110);
        color: white
    }

    .side-chat-body-messenger-user-message {
        align-self: flex-end;
        padding: 0.7rem;
        margin: 0.2rem;
        background-color: rgb(74, 74, 197);
        border-radius: 1rem 1rem 0 1rem;
        color: white;
        /* font-size: 1.1rem; */
        max-width: 75%;
    }

    .side-chat-body-messenger-non-user-message {
        align-self: flex-start;
        padding: 0.7rem;
        margin: 0.2rem;
        background-color: rgb(180, 180, 180);
        border-radius: 1rem 1rem 1rem 0;
        color: black;
        /* font-size: 1.1rem; */
        max-width: 75%;
    }

    .side-chat-body-contacts {
        flex: 40%;
        height: 100%;
        background-color: var(--contacts);
        overflow-y: auto;
        border-left: 1px solid darkgrey;
    }

    .side-chat-body-contacts-conversation {
        display: flex;
        flex-flow: nowrap;
        align-items: center;
        align-content: center;

        padding: 7px;
        margin: 3px 1rem;
        border-radius: 0.5rem;

    }

    .side-chat-body-contacts-conversation:hover {
        background-color: white;
    }

    .side-chat-body-contacts-conversation img {
        flex-shrink: 0;

        width: 40px;
        height: 40px;
        border: 1px solid lightgrey;
        border-radius: 50%;
        object-fit: cover;

        margin-right: 1rem;
    }

    .side-chat-body-contacts-conversation span {
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
</div>


<!-- side chat -->
<div class="side-chat side-chat-position side-chat-transition side-chat-variables" data-js="side-chat-main">


    <!-- header -->
    <div class="side-chat-header">
        <div class="side-chat-close-button side-chat-button" data-js="side-chat-close-button">
            @include('svg.arrow-right')</div>
    </div>


    <!-- body -->
    <div class="side-chat-body">

        <!-- messenger -->
        <div class="side-chat-body-messenger">

            <div class="side-chat-body-messenger-messages" data-js="side-chat-body-messenger-messages">
                {{-- messages --}}
            </div>

            <form class="side-chat-body-messenger-form" data-js="side-chat-body-messenger-form">
                <input class="side-chat-body-messenger-input" name="chat_message"
                    data-js="side-chat-body-messenger-input" placeholder="Aa..." autofocus autocomplete="off">
                <input data-js="side-chat-body-messenger-hidden-input" type="hidden" name="message_header_id">
                @csrf
            </form>

        </div>
        <!-- //messenger -->

        <!-- contacts -->
        <div class="side-chat-body-contacts" data-js="side-chat-body-contacts"></div>

    </div>


    <!-- footer -->
    <div class="side-chat-footer"></div>


</div>



{{-- ------------------------------------------------------------------------------------ --}}



<script>
    function SideChat() {
        'use strict'
        
        //DOM
        let openButton = document.querySelector('[data-js="side-chat-open-button"]');
        !openButton&&console.error('query selector not found');
        
        let closeButton = document.querySelector('[data-js="side-chat-close-button"]');
        !openButton&&console.error('query selector not found');
        
        let sideChatMain = document.querySelector('[data-js="side-chat-main"]');
        !sideChatMain&&console.error('query selector not found');
        
        let sideChatBodyContacts = document.querySelector('[data-js="side-chat-body-contacts"]');
        !sideChatBodyContacts&&console.error('query selector not found');
       
        let sideChatBodyMessengerForm = document.querySelector('[data-js="side-chat-body-messenger-form"]');
        !sideChatBodyMessengerForm&&console.error('query selector not found');
       
        let sideChatBodyMessengerInput = document.querySelector('[data-js="side-chat-body-messenger-input"]');
        !sideChatBodyMessengerInput&&console.error('query selector not found');
       
        let sideChatBodyMessengerHiddenInput = document.querySelector('[data-js="side-chat-body-messenger-hidden-input"]');
        !sideChatBodyMessengerHiddenInput&&console.error('query selector not found');
        
        let sideChatBodyMessengerMessages = document.querySelector('[data-js="side-chat-body-messenger-messages"]');
        !sideChatBodyMessengerMessages&&console.error('query selector not found');
        

        //EVENTS
        openButton.addEventListener('click', function (e) {
            sideChatMain.classList.add('side-chat-open')
            openButton.style.display = "none";
            sideChatRefreshConversations();
        });
       
        closeButton.addEventListener('click', function (e) {
            sideChatMain.classList.remove('side-chat-open')
            openButton.style.display = "block";
        });

        //sumbit
        sideChatBodyMessengerForm.addEventListener('submit', async () => {
            event.preventDefault();

            await sideChatSendMessage(sideChatBodyMessengerForm);
            sideChatRefreshMessenger(sideChatBodyMessengerForm);

            sideChatBodyMessengerInput.value = "";

        })


        
        //RENDER

        //render CONVERSATIONS
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.conversations, newState.conversations)) {

                let chatConversations = 
                    newState.conversations.map((conversationData) => {
                        
                        return `<div class="side-chat-body-contacts-conversation" 
                                        data-js="side-chat-body-contacts-conversation">
                                    <img src="${conversationData.image}">
                                    <span>${conversationData.name}</span>
                                    <form>
                                        <input type="hidden" name="message_header_id" value="${conversationData.message_header_id}">
                                        @csrf 
                                    </form>
                                </div>
                                `;
                    });
                sideChatBodyContacts.innerHTML = chatConversations.join('');

                //rendered EVENTS
                let allDomConversations = document.querySelectorAll('[data-js="side-chat-body-contacts-conversation"]');
                allDomConversations.length==0&&console.error('query selector not found', allDomConversations);
                
                //each conversation
                allDomConversations.forEach((dOMConversation) => {
                    
                    //conversation on click
                    dOMConversation.addEventListener('click', (e) => {

                        let conversationHiddenForm = dOMConversation.querySelector('form');

                        sideChatRefreshMessenger(conversationHiddenForm);


                        sideChatBodyMessengerInput.focus();
                        sideChatBodyMessengerInput.value = "";
                    });


                });//each


            }//if state change
        })//


        //render MESSAGES & CONVERSATION-ID
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.messenger_messages, newState.messenger_messages)) {

                let messages = newState.messenger_messages.map((chat) => {
                    let isUser = <?php echo Auth::user()?Auth::user()->id:''?> == chat.user.id;
                    return isUser
                            ? `<span class="side-chat-body-messenger-non-user-message">${chat.body}</span>`
                            : `<span class="side-chat-body-messenger-user-message">${chat.body}</span>`;
                });

                sideChatBodyMessengerMessages.innerHTML = messages.join('');
                sideChatBodyMessengerMessages.scrollTo(0, sideChatBodyMessengerMessages.scrollHeight);

            }//if state change
        });//sub

        //render CONVERSATION-ID
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.messenger_conversation_id, newState.messenger_conversation_id)) {

                sideChatBodyMessengerHiddenInput.value = newState.messenger_conversation_id;

            }//if state change
        });//sub


    }//
    SideChat();

</script>
 

   /**
    * TODO:
    * 
    * WORK ON SOCKETS
    * 
    * SHOW HINT FOR UNREAD MESSAGES FOR EACH CONVERSATION IN CONTACT LIST
    * AND OF TOTAL UNREAD MESSAGES ON SIDECHAT BUTTON
    * 
    * BE ABLE TO ADD A NEW USER (CREATE A MESSAGE HEADER ASSUMING DOESNT ALREADY EXIST)
    * 
    * DISALLOW SELECTING A NEW CONVERSATION WHILST A MESSAGE IS BEING SENT AND REFRESHED
    * 
    * /