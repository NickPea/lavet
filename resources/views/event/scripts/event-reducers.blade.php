{{--  --}}



<script>
   

/* ---------------------------------------------- UI -----------------------------------------------*/

    // -- show-attending-modal
    store.addReducer(
            function event_attending_modal_show(state = false, action) {
                switch (action.type) {
                    case 'event_attending_modal/show':
                        return true;
                        break;
                    case 'event_attending_modal/hide':
                        return false;
                        break;
                    default:
                        return state;
                        break;
                }
            }
        );


/* ---------------------------------------------- DATA -----------------------------------------------*/

             // -- comments
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

     // -- attendees
     store.addReducer(
        function event_atttending_all_attendees(state = [], action) {
            switch (action.type) {
                case 'event_attending_all_attendess/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

</script>