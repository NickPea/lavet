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
        --shadow2: 0 0 10px 10px black;
    }

    /* side-chat */

    .side-chat {
        height: 100%;
        width: 0vw;
        z-index: 9999999999999999;
        overflow: hidden;

        box-shadow: var(--shadow1)
    }

    .side-chat-open {
        width: 40vw;
    }

    .side-chat-transition {
        transition: width 200ms ease;
    }

    /* header */

    .side-chat-header {
        height: 5%;
        background-color: var(--header);

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
        flex: 70%;
        height: 100%;
        background-color: var(--messenger);
        overflow-y: auto;

    }

    .side-chat-body-contacts {
        flex: 30%;
        height: 100%;
        background-color: var(--contacts);
        overflow-y: auto;
        border-left: 1px solid darkgrey;
    }


    /* footer */

    .side-chat-footer {
        height: 5%;
        background-color: var(--footer);

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

        <div class="side-chat-body-messenger"></div>

        <div class="side-chat-body-contacts" data-js="side-chat-body-contacts"></div>

    </div>


    <!-- footer -->
    <div class="side-chat-footer"></div>


</div>



{{-- ------------------------------------------------------------------------------------ --}}



<script>
    function SideChat() {
        
        
        //DOM
        let openButton = document.querySelector('[data-js="side-chat-open-button"]');
        !openButton&&console.error('query selector not found');
        
        let closeButton = document.querySelector('[data-js="side-chat-close-button"]');
        !openButton&&console.error('query selector not found');
        
        let sideChatMain = document.querySelector('[data-js="side-chat-main"]');
        !sideChatMain&&console.error('query selector not found');
        
        let sideChatBodyContacts = document.querySelector('[data-js="side-chat-body-contacts"]');
        !sideChatBodyContacts&&console.error('query selector not found');
        


        //EVENTS
        openButton.addEventListener('click', function (e) {
            sideChatMain.classList.add('side-chat-open')
            openButton.style.display = "none";
            sideChatRefreshConversations(); //scripts/endpoints
        });
       
        closeButton.addEventListener('click', function (e) {
            sideChatMain.classList.remove('side-chat-open')
            openButton.style.display = "block";
        });

        //RENDER

        //render store conversations in side-chat-body-contacts
        chatStore.subscribe((oldState, newState) => {

            if (!_.isEqual(oldState.conversations, newState.conversations)) {

                //prep
                let chatConversations = 
                    newState.conversations.map((convo) => {
                        
                        //TODO
                        return `<div>convo here</div>`;
                    })

                //append
                sideChatBodyContacts.innerHTML = chatConversations.join('');

            }//if
        })//










    }//
    SideChat();

</script>