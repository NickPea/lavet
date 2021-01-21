{{--  --}}


<style>
    .profile-button-bar-wrapper {
        display: flex;
        flex-flow: wrap;
        justify-content: start;
        align-content: space-between;
    }

    #profile-button-bar-message-button:hover .svg-icon-hover-white {
        fill: white;
    }
</style>


<!-- --------------------------------------------------------------------------------------------------------- -->


<div class="profile-button-bar-wrapper">

    <div class="btn-group">
        <!-- more -->
        <button class="btn btn-outline-secondary btn-lg mb-2 dropdown-toggle" data-toggle="dropdown">
            <span>@include('svg.more')</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <h6 class="dropdown-header">More options</h6>
            <button class="dropdown-item" type="button">
                <span>@include('svg.report')</span>
                <span>Report User</span>
            </button>
            {{-- <button class="dropdown-item" type="button">Block</button> --}}
        </div>
    </div>

    <!-- share -->
    <button class="btn btn-outline-secondary btn-lg ml-2 mb-2 ">
        <span>@include('svg.share')</span>
        {{-- <span>Share</span> --}}
    </button>

    <!-- message -->
    <button data-js="profile-button-bar-message-button" class="btn btn-outline-secondary btn-lg ml-auto mb-2"
        id="profile-button-bar-message-button">
        <span class="d-flex">
            <span>@include('svg.chat-grey')</span>
            <span class="ml-2">Message</span>
        </span>
    </button>


</div>


<!-- --------------------------------------------------------------------------------------------------------- -->


<script>
    function ButtonBar() {
        const messageButton = document.querySelector('[data-js="profile-button-bar-message-button"]');
        !messageButton&&console.error('dom query not found');

        messageButton.addEventListener('click', async () => {
            const profileIdFromURL = window.location.pathname.split('/')[2];
            
            const conversation = await sideChatAddConversationFromProfileId(profileIdFromURL);

            //get message_header_id from above endpoint and pass to below endpoints (with _token) as html form

            const hiddenForm = document.createElement('form');
            hiddenForm. innerHTML = `
                    <input name="message_header_id" value="${conversation.id}">
                    <input name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                    `;

            await sideChatMarkConversationMessagesAsRead(hiddenForm);
            await sideChatRefreshMessenger(hiddenForm);

            chatStore.publish({type: 'messenger/open'});

        })
    }
    document.addEventListener('DOMContentLoaded', ButtonBar);


</script>