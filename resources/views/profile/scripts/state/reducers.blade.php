{{-- 
Reducers:
The reducer function name and the default state value 
are, by convention, used as the state key name and initial value, respecitivley.
i.e counter(state = 2, action) = {couter: 2} 
--}}


<script>
    // DATA REDUCERS //

    // -- profile image
    store.addReducer(
        function image(state = {}, action) {
            switch (action.type) {
                case 'image/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- name
    store.addReducer(
        function name(state = {}, action) {
            switch (action.type) {
                case 'name/refresh':
                    return action.payload.name
                    ;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // --field
    store.addReducer(
        function field(state = {}, action) {
            switch (action.type) {
                case 'field/refresh':
                    return action.payload.field;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- position
    store.addReducer(
        function position(state = {}, action) {
            switch (action.type) {
                case 'position/refresh':
                    return action.payload.position;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // --location
    store.addReducer(
        function location(state = {}, action) {
            switch (action.type) {
                case 'location/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- user-images
    store.addReducer(
        function user_images(state = [], action) {
            switch (action.type) {
                case 'user-images/refresh':
                    return action.payload.user_images;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- about
    store.addReducer(
        function about(state = '', action) {
            switch (action.type) {
                case 'about/refresh':
                    return action.payload.about;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    // -- credential
    store.addReducer(
        function credential(state = {}, action) {
            switch (action.type) {
                case 'credential/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- experience
    store.addReducer(
        function experience(state = {}, action) {
            switch (action.type) {
                case 'experience/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- reference
    store.addReducer(
        function reference(state = {}, action) {
            switch (action.type) {
                case 'reference/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    // -- chat
    store.addReducer(
        function messages(state = [], action) {
            switch (action.type) {
                case 'chat/refresh':
                    return action.payload;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    
</script>

{{-- -------------------------------------------------------------------------------- --}}

<script>
    // UI REDUCERS //


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
        function showProfileImageModalCamera(state = false, action) {
            switch (action.type) {
                case 'profile-image-modal-main-content/toggle-camera':
                    return !state;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );

    //edit profile modal
    store.addReducer(
        function showProfileEditModal(state = false, action) {
            switch (action.type) {
                case 'profile-edit-modal/toggle':
                    return !state;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showNameEdit(state = false, action) {
            switch (action.type) {
                case 'profile-edit-modal-name/toggle':
                    return !state;
                    break;
                case 'profile-edit-modal-name/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showCareerStatusEdit(state = false, action) {
            switch (action.type) {
                case 'profile-edit-modal-career-status/toggle':
                    return !state;
                    break;
                case 'profile-edit-modal-career-status/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showWhereaboutsEdit(state = false, action) {
            switch (action.type) {
                case 'profile-edit-modal-whereabouts/toggle':
                    return !state;
                    break;
                case 'profile-edit-modal-whereabouts/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showAboutForm(state = false, action) {
            switch (action.type) {
                case 'profile-about-form/toggle':
                    return !state;
                    break;
                case 'profile-about-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showCredentialAddForm(state = false, action) {
            switch (action.type) {
                case 'profile-credential-add-form/toggle':
                    return !state;
                    break;
                case 'profile-credential-add-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showCredentialEditForm(state = false, action) {
            switch (action.type) {
                case 'profile-credential-edit-form/toggle':
                    return !state;
                    break;
                case 'profile-credential-edit-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showExperienceAddForm(state = false, action) {
            switch (action.type) {
                case 'profile-experience-add-form/toggle':
                    return !state;
                    break;
                case 'profile-experience-add-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function experienceAddFormIsCurrent(state = false, action) {
            switch (action.type) {
                case 'profile-experience-add-form-is-current/toggle':
                    return !state;
                    break;
                case 'profile-experience-add-form-is-current/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showExperienceEditForm(state = false, action) {
            switch (action.type) {
                case 'profile-experience-edit-form/toggle':
                    return !state;
                    break;
                case 'profile-experience-edit-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function experienceEditFormIsCurrent(state = false, action) {
            switch (action.type) {
                case 'profile-experience-edit-form-is-current/toggle':
                    return !state;
                    break;
                case 'profile-experience-edit-form-is-current/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );
    store.addReducer(
        function showReferenceAddForm(state = false, action) {
            switch (action.type) {
                case 'profile-reference-add-form/toggle':
                    return !state;
                    break;
                case 'profile-reference-add-form/off':
                    return false;
                    break;
                default:
                    return state;
                    break;
            }
        }
    );


</script>