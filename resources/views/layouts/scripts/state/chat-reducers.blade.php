{{--  --}}

<!-- Chat Store Reducers -->

<script>
    // -- 
    chatStore.addReducer(
        function conversations(state = [], action) {
            switch (action.type) {
                case 'conversations/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }//sw
        }//fn
    );//

    chatStore.addReducer(
        function messenger_messages(state = [], action) {
            switch (action.type) {
                case 'messenger/refresh-messages':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }//sw
        }//fn
    );//

    chatStore.addReducer(
        function messenger_conversation_id(state = '', action) {
            switch (action.type) {
                case 'messenger/refresh-conversation-id':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }//sw
        }//fn
    );//
   

</script>