{{--  --}}



<script>

    function sideChatRefreshConversations() {
        let url = new URL(`${window.location.origin}/sidechat/conversations/refresh`);
        fetch(url)
            .then((data) => data.json())
            .then((conversations) => {
                chatStore.publish({
                    type: 'conversations/refresh',
                    payload: conversations
                })//publish
            })//then
        
    }//


</script>