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

   // -- edit-modal
    store.addReducer(
       function event_edit_modal_show(state = false, action) {
           switch (action.type) {
               case 'event-edit-modal/show':
                   return true
                   break;
                case 'event-edit-modal/hide':
                   return false
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



   //--------------------- CURRENTLY WORKING ON 28TH JANUARY -----------------------------------------------


   
    // -- hostedby
    store.addReducer(
        function event_hosted_by(state = {}, action) {
            switch (action.type) {
                case 'event-hosted-by/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- title
    store.addReducer(
        function event_title(state = {}, action) {
            switch (action.type) {
                case 'event-title/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- image
    store.addReducer(
        function event_image(state = {}, action) {
            switch (action.type) {
                case 'event-image/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- who
    store.addReducer(
        function event_who(state = {}, action) {
            switch (action.type) {
                case 'event-who/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- what
    store.addReducer(
        function event_what(state = {}, action) {
            switch (action.type) {
                case 'event-what/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- tag
    store.addReducer(
        function event_tag(state = [], action) {
            switch (action.type) {
                case 'event-tag/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- about
    store.addReducer(
        function event_about(state = {}, action) {
            switch (action.type) {
                case 'event-about/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- access
    store.addReducer(
        function event_access(state = {}, action) {
            switch (action.type) {
                case 'event-access/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- when
    store.addReducer(
        function event_when(state = {}, action) {
            switch (action.type) {
                case 'event-when/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- time
    store.addReducer(
        function event_time(state = {}, action) {
            switch (action.type) {
                case 'event-time/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- location
    store.addReducer(
        function event_location(state = {}, action) {
            switch (action.type) {
                case 'event-location/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

</script>