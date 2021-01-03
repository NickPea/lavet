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
   

</script>