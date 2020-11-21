
{{--  --}}



<script>

    //Reducers
    /*
    *NB:
    * The reducer function name and the default state value 
    * are, by convention, used as the state key name and initial value, respecitivley.
    * i.e counter(state = 2, action) = {couter: 2}
    */


    //location
    store.addReducer(
        function locationFormVisible(state = false, action) {
            switch (action.type) {
                case 'location/toggle-form':
                    return !state
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function location(state = {}, action) {
            switch (action.type) {
                case 'location/update-data':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showHeaderForm(state = false, action) {
            switch (action.type) {
                case 'header/toggle-form':
                    return !state;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function header(state = {}, action) {
            switch (action.type) {
                case 'header/update-data':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function profileImage(state = {}, action) {
            switch (action.type) {
                case 'profile-image/update-data':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showProfileImageModal(state = false, action) {
            switch (action.type) {
                case 'profile-image-modal/toggle':
                    return !state;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function profileModalImages(state = [], action) {
            switch (action.type) {
                case 'profile-image-modal/update-data':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );


</script>




