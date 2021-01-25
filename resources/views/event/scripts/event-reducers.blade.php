{{--  --}}



<script>
   

/* ---------------------------------------------- UI -----------------------------------------------*/

    // -- show-attending-modal
    store.addReducer(
            function event_attending_modal_show(state = false, action) {
                switch (action.type) {
                    case 'event-attending-modal/show':
                        return true;
                        break;
                    case 'event-attending-modal/hide':
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
                case 'event-comments/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- attending-count
    store.addReducer(
       function event_attending_count(state = 0, action) {
           switch (action.type) {
               case 'event-attending-count/refresh':
                   return action.payload;
                   break;
               default:
                   return state;
                   break;
           }
       }
   );
    // -- attending-some
    store.addReducer(
       function event_some_attending(state = [], action) {
           switch (action.type) {
               case 'event-some-attending/refresh':
                   return action.payload;
                   break;
               default:
                   return state;
                   break;
           }
       }
   );

    // -- attending-all
    store.addReducer(
       function event_atttending_all_attendees(state = [], action) {
           switch (action.type) {
               case 'event-attending-all-attendees/refresh':
                   return action.payload;
                   break;
               default:
                   return state;
                   break;
           }
       }
   );
    
   // -- rsvp-prompt
    store.addReducer(
       function event_rsvp_prompt_show(state = false, action) {
           switch (action.type) {
               case 'event-rsvp-prompt/show':
                   return true
                   break;
               case 'event-rsvp-prompt/hide':
                   return false
                   break;
               default:
                   return state;
                   break;
           }
       }
   );

</script>