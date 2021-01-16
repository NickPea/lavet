{{--  --}}

<!-- Chat Store Reducers -->

<script>
    // -- 

    chatStore.addReducer(
        function total_unread_count(state = [], action) {
            switch (action.type) {
                case 'total-unread-count/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }//sw
        }//fn
    );//

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

    chatStore.addReducer(
        function currently_typing(state = [], action) {
            switch (action.type) {
                case 'currently-typing/add-conversation':
                {
                    console.error('add-convo');
                    const newState = [...state];
                    newState.push(action.payload)
                    return newState;
                }
                break;
                case 'currently-typing/remove-conversation':
                {
                    console.error('remove-convo');
                    const newState = state.filter((name) => {
                        name !== action.payload;
                    });
                    return newState;
                }
                break;
                default:
                    return state;
                break;
            }//sw
        }//fn
    );//

    
   

</script>