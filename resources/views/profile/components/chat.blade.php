{{--  --}}


<style>
    .chat-position {
        position: fixed;
        bottom: 10%;
        right: 10%;
    }

    .chat-box {
        height: 500px;
        width: 350px;
        background-color: red;
        box-shadow: 0 0 5px 1px grey;
        border-radius: 1rem;
        overflow: hidden;

        transition: 250ms ease;
    }

    .chat-header {
        height: 10%;
        background-color: whitesmoke;

        box-shadow: 0 0 10px 5px grey;
        position: relative;
        /** needed for z-index */
        z-index: 1;

        display: flex !important;
        align-items: center;
        padding: 0 0.5rem;
    }

    .chat-header:hover {
        background-color: rgb(211, 211, 211);
        cursor: pointer;
    }

    .chat-header-image {
        border-radius: 50%;
        object-fit: cover;
        height: 35px;
        width: 35px;
    }

    .chat-header-title {
        font-weight: bolder;
        padding-left: 1rem;
        margin: 0;
    }

    .chat-header-close {
        margin-left: auto;
    }

    .chat-messages {
        height: 80%;
        background-color: white;
        padding: 0 1rem;
        overflow-y: auto;
        scroll-behavior: smooth;

        display: flex;
        flex-direction: column;
    }
    .user-chat-message {
        align-self: flex-end;
        padding: 0.7rem;
        margin: 0.2rem;
        background-color: rgb(74, 74, 197);
        border-radius: 1rem 1rem 0 1rem;
        color:white ; 
        /* font-size: 1.1rem; */
        max-width: 75%;
    }

    .non-user-chat-message {
        align-self: flex-start;
        padding: 0.7rem;
        margin: 0.2rem;
        background-color: rgb(180, 180, 180);
        border-radius: 1rem 1rem 1rem 0;
        color:black ; 
        /* font-size: 1.1rem; */
        max-width: 75%;
    }
    
    .chat-input {
        height: 10%;
        width: 100%;
        padding: 1rem;
        letter-spacing: 2px;
        font-size: 1rem;
        border: none;
        background-color: rgb(221, 221, 221);
    }

    .chat-input:hover {
        background-color: rgb(199, 199, 199);
    }

    .chat-input:focus {
        outline: none;
        background-color: rgb(110, 110, 110);
        color: white
    }

    .chat-tab {
        display: none;
    }

    /* MQs */
    @media screen and (max-width : 700px) {
        .chat-position {
            right: calc(50% - 175px);
        }
    }
</style>

<!-- ------------------------------------------------------------------------------------------ -->


<div class="chat-position">
    <div class='chat-box' data-js="chat-box">

        <div class="chat-header" data-js="chat-header">
            <img class="chat-header-image" src="{{$profile->image->first()->path}}">
            <h6 class="chat-header-title">{{$profile->user->name}}</h6>
            <i class="chat-header-close" data-js="chat-header-close">@include('svg.remove')</i>
        </div>

        <div class="chat-messages" data-js="chat-messages">
            {{-- inserted messages --}}
        </div>

        <form data-js="chat-form">
            <input class="chat-input" name="chatMessage" data-js="chat-input" placeholder="Aa..." autofocus
                autocomplete="off">
            @csrf
        </form>

    </div><!-- //chat-box -->
</div>



<!-- ------------------------------------------------------------------------------------------ -->

<script>

    'use strict'


    function ChatBox() {

        //------------------------------- UI Functionality --------------------------------------

        let chatBox = document.querySelector('[data-js="chat-box"]')
        !chatBox && console.error('dom query not found');

        let chatHeader = document.querySelector('[data-js="chat-header"]')
        !chatHeader && console.error('dom query not found');

        let chatHeaderClose = document.querySelector('[data-js="chat-header-close"]')
        !chatHeaderClose && console.error('dom query not found');
        
        let chatMessages = document.querySelector('[data-js="chat-messages"]')
        !chatMessages && console.error('dom query not found');
        
        let chatInput = document.querySelector('[data-js="chat-input"]')
        !chatInput && console.error('dom query not found');
       
        let chatForm = document.querySelector('[data-js="chat-form"]')
        !chatForm && console.error('dom query not found');
   
        
        //Send then refresh chat messages in store 
        chatForm.addEventListener('submit', async () => {
            
            event.preventDefault();

            if (chatInput.value != '') {

                await sendAndRefreshProfileChatMessages(chatForm);

                //clean up
                chatInput.value = "";
                chatMessages.scrollTo(0, chatMessages.scrollHeight);

            }
        });

        //Render chat messages from store on change
        store.subscribe((oldState, newState) => {
            if (!_.isEqual(oldState.messages, newState.messages)) {
                let messages = newState.messages.map((chat) => {
                    
                    let isUser = <?php echo Auth::user()->id?> == chat.user.id
                    let mapping;

                    if (isUser) {
                        mapping = `<span class="user-chat-message">${chat.body}</span>`;

                    } else {
                        mapping = `<span class="non-user-chat-message">${chat.body}</span>`;
                    }

                    return mapping;   
                });
                chatMessages.innerHTML = messages.join('');
            }//if
        })

        //toggle chat open and close
        let chatBoxIsOpen = true;
        chatHeader.addEventListener('click', () => {
            if (chatBoxIsOpen) {
                chatBox.style.height = '50px';
                chatBox.style.width  = '50px';
                chatHeader.style.height = '100%';
                chatHeaderClose.innerHTML = '@include('svg.add')'
                chatMessages.style.display = 'none';
                chatInput.style.display = 'none';
            } else {
                chatBox.style.height = '500px';
                chatBox.style.width = '350px';
                chatHeader.style.height = '10%';
                chatHeaderClose.innerHTML = '@include('svg.remove')'
                chatMessages.style.display = 'flex';
                chatInput.style.display = 'block';
                chatInput.focus();
            }
            chatBoxIsOpen = !chatBoxIsOpen; 
            
        });
        chatHeader.click(); //close chatbox on page load/refresh


        //-------------------------------SOCKET.IO-CLIENT--------------------------------------

         let userEmailHash = '<?php echo hash(hash_algos()[5], Auth::user()->email??'')?>'; //SHA-256
        //todo: store in database user table on registration

        // ----------------- Connect -------------------------
        const socket = io('http://localhost:5000');

        // ----------------- Events -------------------------
        
        socket.on('connect', () => {
            socket.emit('map-socket-user', {userEmailHash: userEmailHash});
            console.error(`-- CONNECTED: mapping user & socket -- \n userEmailHash: ${userEmailHash}, socket.id: ${socket.id}`);
        });

        socket.on('disconnect', (reason) => {
            console.error(`-- DISCONNECTED -- ${reason} \n userEmailHash: ${socket.userEmailHash}, socket: ${socket.id},`);
        });

        socket.on('FROM-NODE-TO-BROWSER', async (data) => {
            await refreshProfileChatMessages();
            chatMessages.scrollTo(0, chatMessages.scrollHeight);

        });

        //-------------------------------// END SOCKET //--------------------------------------//


    }//ChatBox
    document.addEventListener('DOMContentLoaded', ChatBox);

</script>