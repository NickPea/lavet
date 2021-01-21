{{--  --}}



<script>

    // -- EXAMPLE
    store.addReducer(
        function event_comments(state = [], action) {
            switch (action.type) {
                case 'event_comments/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

/* ---------------------------------------------- UI -----------------------------------------------*/




/* ---------------------------------------------- DATA -----------------------------------------------*/


</script>