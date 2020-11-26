{{--  --}}

<style>
    .edit-profile-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        /*prevent background scrolling*/
        background-color: rgba(0, 0, 0, 0.4);
    }

    .edit-profile-modal-content {
        position: relative;
        background-color: #fefefe;
        margin-left: auto;
        margin-right: 10rem;
        margin-top: 10vh;
        margin-bottom: 50vh;
        /*prevent background scrolling*/
        width: 50%;
        padding: 3rem;
        object-fit: cover;
        border-radius: 1rem;
    }

    .modal-title {
        display: inline;
        padding: 0.3rem 0;
        border-bottom: 2px solid lightgrey;
    }

    .hide {
        display: none;
    }
</style>



{{-- ------------------------------------------------------------------------------------- --}}



<!-- The Modal -->
<div data-js="edit-profile-modal" class="edit-profile-modal">


    <!-- Modal content -->
    <div class="edit-profile-modal-content">




        <!-- ------------------------------------CLOSE BUTTON-------------------------------------------- -->

        <span data-js="edit-modal-close" class="options-button"
            style="position: absolute; right:3rem; top:2rem; transform:scale(1.5,1.5);">
            @include('svg.close')
        </span>


        <!-- ------------------------------------HEADER-------------------------------------------- -->

        <div class="d-flex justify-content-center">
            <h4 class="m-0"><b>Update Your Details</b></h4>
        </div>

        <hr><!-- break -->


        <!-- -----------------------------------------MAIN CONTENT AREA---------------------------------------- -->

        {{-- SUB-HEADING --}}
        <div class="row">

            <div class="col">
                <h5 class="modal-title"><b>Identity</b></h5>
            </div>

            <!-- edit button -->
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <a data-js="pem-edit-identity" class="edit-button">
                        @include('svg.edit')
                    </a>
                </div>
            </div>
        </div><!-- //row -->


        <div class="row pt-4 pb-5">
            <div class="col-10 offset-1">

                {{-- DISPLAY --}}
                <div data-js="name-display-wrapper">
                    <div class="content-wrapper d-flex flex-column">
                        <!-- Name -->
                        <small class="mb-2">Name</small>
                        <h5 class="font-weight-bold m-0">
                            <span data-js="pem-name"></span>
                        </h5>
                    </div>
                </div>

                {{-- HIDDEN FORM --}}
                <form data-js="pem-name-form" class="hide">
                    @csrf
                    @method('PUT')

                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" id="name" placeholder="Name" class="form-control form-control-lg">
                    </div>

                    <!-- buttons -->
                    <div class="d-flex justify-content-end">
                        <button data-js="pem-name-form-cancel" tabindex="-1"
                            class="btn btn-outline-secondary btn-lg">cancel</button>
                        <button class="ml-2 btn btn-primary btn-lg" type="submit">Update</button>
                    </div>
                </form>

            </div><!-- //col -->
        </div><!-- //row -->

        {{-- ------------------------------------------------------------------- --}}

        {{-- SUB-HEADING --}}
        <div class="row">
            <div class="col">
                <h5 class="modal-title"><b>Career Status</b></h5>
            </div>

            <!-- edit button -->
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <a data-js="pem-edit-career-status" class="edit-button">
                        @include('svg.edit')
                    </a>
                </div>
            </div>
        </div><!-- //row -->


        <div class="row pt-4 pb-5">
            <div class="col-10 offset-1">

                {{-- DISPLAY --}}
                <div data-js="career-status-display-wrapper">
                    <div class="content-wrapper d-flex flex-column">
                        <!-- Field -->
                        <small class="mb-2">Field</small>
                        <h5 class="font-weight-bold mb-2">
                            <span data-js="pem-field"></span>
                        </h5>
                        <!-- Position -->
                        <small class="mb-2">Position</small>
                        <h5 class="font-weight-bold m-0">
                            <span data-js="pem-position"></span>
                        </h5>
                    </div>
                </div>


                {{-- HIDDEN FORMS --}}
                {{-- Nb: this form is seperated into seperate form elements to allow for 
                    seperate FormData objects to be sent on seperate fetch requests on submit --}}
                <div data-js="pem-career-status-form-wrapper" class="hide">

                    <form data-js="pem-field-form">
                        <!-- tokens -->
                        @csrf
                        @method('PUT')

                        <!-- field -->
                        <div class="form-group">
                            <label for="field">Field</label>
                            <input name="field" id="field" placeholder="Field" class="form-control form-control-lg">
                        </div>
                    </form>

                    <form data-js="pem-position-form">
                        <!-- tokens -->
                        @csrf
                        @method('PUT')

                        <!-- position -->
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input name="position" id="position" placeholder="Position"
                                class="form-control form-control-lg">
                        </div>
                    </form>

                    {{-- This form's submit pulls the FormData from Field and Postion forms --}}
                    <form data-js="pem-career-status-form-activator">
                        <!-- buttons -->
                        <div class="d-flex justify-content-end">
                            <button data-js="pem-career-status-form-wrapper-cancel" tabindex="-1"
                                class="btn btn-outline-secondary btn-lg">cancel</button>
                            <button class="ml-2 btn btn-primary btn-lg" type="submit">Update</button>
                        </div>
                    </form>

                </div><!-- hide-wrapper -->

            </div><!-- //col -->
        </div><!-- //row -->

        {{-- ------------------------------------------------------------------- --}}


        {{-- SUB-HEADING --}}
        <div class="row">
            <div class="col">
                <h5 class="modal-title"><b>Whereabouts</b></h5>
            </div>

            <!-- edit button -->
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <a data-js="pem-edit-whereabouts" class="edit-button">
                        @include('svg.edit')
                    </a>
                </div>
            </div>
        </div><!-- //row -->


        <div class="row pt-4 pb-5">
            <div class="col-10 offset-1">

                {{-- DISPLAY --}}
                <div data-js="whereabouts-display-wrapper">
                    <div class="content-wrapper d-flex flex-column">
                        <small class="mb-2">Location</small>
                        <h5 class=" font-weight-bold m-0 d-inline">
                            <span data-js="pem-city"></span>
                            <span data-js="pem-province"></span>
                            <span data-js="pem-area-code"></span>
                            <span data-js="pem-uknonwn"></span>
                        </h5>
                        <h6 class="mt-1">
                            <div data-js="pem-country"></div>
                        </h6>
                    </div>
                </div>


                {{-- HIDDEN FORM --}}
                <form data-js="pem-whereabouts-form" class="hide">
                    <!-- tokens -->
                    @csrf
                    @method('PUT')

                    <!-- city -->
                    <div class="form-group">
                        <label for="city">City</label>
                        <input name="city" id="city" placeholder="City..."
                            class="form-control form-control-lg form-control-block">
                    </div>

                    <!-- province -->
                    <div class="form-group">
                        <label for="province">State</label>
                        <input name="province" id="province" placeholder="State..."
                            class="form-control form-control-lg form-control-block">
                    </div>

                    <!-- area_code -->
                    <div class="form-group">
                        <label for="area_code">Post Code</label>
                        <input name="area_code" id="area_code" placeholder="Post Code..."
                            class="form-control form-control-lg form-control-block">
                    </div>

                    <!-- country -->
                    <div class="form-group">
                        <label for="country">Country*</label>
                        <input name="country" id="country" required placeholder="Country..."
                            class="form-control form-control-lg form-control-block">
                    </div>

                    <!-- buttons -->
                    <div class="d-flex justify-content-end">
                        <button data-js="pem-whereabouts-form-cancel" tabindex="-1"
                            class="btn btn-outline-secondary btn-lg">cancel</button>
                        <button class="ml-2 btn btn-primary btn-lg" type="submit">Update</button>
                    </div>
                </form>

            </div><!-- //col -->
        </div><!-- //row -->



        <!-- -----------------------------------------//MAIN CONTENT AREA---------------------------------------- -->



    </div><!-- //Modal-Content -->

</div><!-- //Modal -->


{{-- ------------------------------------------------------------------------------------- --}}


<script>
    function EditProfileModal() {

        //DOM

        // --modal
        let editProfileModal = document.querySelector('[data-js="edit-profile-modal"]');
        let editProfileModalClose = document.querySelector('[data-js="edit-modal-close"]');
        !editProfileModal && console.error('dom query not found');
        !editProfileModalClose && console.error('dom query not found');

        // -- identity
        let editIdentity = document.querySelector('[data-js="pem-edit-identity"]');
        let nameDisplayWrapper = document.querySelector('[data-js="name-display-wrapper"]');
        let nameDisplay = document.querySelector('[data-js="pem-name"]');
        let nameForm = document.querySelector('[data-js="pem-name-form"]');
        let nameFormCancel = document.querySelector('[data-js="pem-name-form-cancel"]');
        !editIdentity && console.error('dom query not found');
        !nameDisplayWrapper && console.error('dom query not found');
        !nameDisplay && console.error('dom query not found');
        !nameForm && console.error('dom query not found');
        !nameFormCancel && console.error('dom query not found');

        // -- career status
        let editCareerStatus = document.querySelector('[data-js="pem-edit-career-status"]');
        let careerStatusDisplayWrapper = document.querySelector('[data-js="career-status-display-wrapper"]');
        let fieldDisplay = document.querySelector('[data-js="pem-field"]');
        let positionDisplay = document.querySelector('[data-js="pem-position"]');
        let careerStatusFormWrapper = document.querySelector('[data-js="pem-career-status-form-wrapper"]');
        let careerStatusFormWrapperCancel = document.querySelector('[data-js="pem-career-status-form-wrapper-cancel"]');
        let careerStatusFormActivator = document.querySelector('[data-js="pem-career-status-form-activator"]');
        let fieldForm = document.querySelector('[data-js="pem-field-form"]');
        let positionForm = document.querySelector('[data-js="pem-position-form"]');
        !editCareerStatus && console.error('dom query not found');
        !careerStatusFormWrapper && console.error('dom query not found');
        !careerStatusFormWrapperCancel && console.error('dom query not found');
        !careerStatusFormActivator && console.error('dom query not found');
        !careerStatusDisplayWrapper && console.error('dom query not found');
        !fieldDisplay && console.error('dom query not found');
        !positionDisplay && console.error('dom query not found');
        !fieldForm && console.error('dom query not found');
        !positionForm && console.error('dom query not found');

        // -- whereabouts
        let editWhereabouts = document.querySelector('[data-js="pem-edit-whereabouts"]');
        let whereaboutsDisplayWrapper = document.querySelector('[data-js="whereabouts-display-wrapper"]');
        let cityDisplay = document.querySelector('[data-js="pem-city"]');
        let provinceDisplay = document.querySelector('[data-js="pem-province"]');
        let countryDisplay = document.querySelector('[data-js="pem-country"]');
        let areaCodeDisplay = document.querySelector('[data-js="pem-area-code"]');
        let whereaboutsForm = document.querySelector('[data-js="pem-whereabouts-form"]');
        let whereaboutsFormCancel = document.querySelector('[data-js="pem-whereabouts-form-cancel"]');
        !editWhereabouts && console.error('dom query not found');
        !whereaboutsDisplayWrapper && console.error('dom query not found');
        !cityDisplay && console.error('dom query not found');
        !provinceDisplay && console.error('dom query not found');
        !countryDisplay && console.error('dom query not found');
        !areaCodeDisplay && console.error('dom query not found');
        !whereaboutsForm && console.error('dom query not found');
        !whereaboutsFormCancel && console.error('dom query not found');

        //EVENTS

         //close on close button
         editProfileModalClose.onclick = function() {
            store.publish({type: 'profile-edit-modal/toggle'});
            store.publish({type: 'profile-edit-modal-name/off'});
            store.publish({type: 'profile-edit-modal-career-status/off'});
            store.publish({type: 'profile-edit-modal-whereabouts/off'});
         }

        //close on outside click
        window. addEventListener('click', () => {
            if (event.target == editProfileModal) {
                store.publish({type: 'profile-edit-modal/toggle'});
                store.publish({type: 'profile-edit-modal-name/off'});
                store.publish({type: 'profile-edit-modal-career-status/off'});
                store.publish({type: 'profile-edit-modal-whereabouts/off'});
            }
        });

        //show subforms on edit button click
        editIdentity.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-name/toggle'})
        });
        editCareerStatus.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-career-status/toggle'})
        });
        editWhereabouts.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-whereabouts/toggle'})
        });

        //unshow subforms on cancel button click
        nameFormCancel.addEventListener('click', () => {
            event.preventDefault()
            store.publish({type: 'profile-edit-modal-name/toggle'})
        });
        careerStatusFormWrapperCancel.addEventListener('click', () => {
            event.preventDefault()
            store.publish({type: 'profile-edit-modal-career-status/toggle'})
        });
        whereaboutsFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-edit-modal-whereabouts/toggle'})
        });
        //show subform on display-wrapper click
        nameDisplayWrapper.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-name/toggle'})
        });
        careerStatusDisplayWrapper.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-career-status/toggle'})
        });
        whereaboutsDisplayWrapper.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal-whereabouts/toggle'})
        });
        //submit nameform 
        nameForm.addEventListener('submit', async () => {
            event.preventDefault()
            await updateProfileName(nameForm);
            refreshProfileName();
            store.publish({type: 'profile-edit-modal-name/toggle'})
        });
        //sumbit career status
        fieldForm.onsubmit = () => event.preventDefault();
        positionForm.onsubmit = () => event.preventDefault();
        careerStatusFormActivator.addEventListener('submit', async () => {
            event.preventDefault()
            await updateProfileField(fieldForm);
            await updateProfilePosition(positionForm);
            refreshProfileField();
            refreshProfilePosition();
            store.publish({type: 'profile-edit-modal-career-status/toggle'})
        });
        //submit whereabouts form
        whereaboutsForm.addEventListener('submit', async () => {
            event.preventDefault();
            await updateProfileLocation(whereaboutsForm);
            refreshProfileLocation();
            store.publish({type: 'profile-edit-modal-whereabouts/toggle'})
        });
        
        //RENDER

        function renderShowEditModal(oldState, newState) {
            if(!_.isEqual(oldState.showProfileEditModal, newState.showProfileEditModal)) {
                if (newState.showProfileEditModal) {
                    editProfileModal.style.display = 'block';
                } else {
                    editProfileModal.style.display = 'none';
                }
            }
        }
        store.subscribe(renderShowEditModal);

        // -- name
        function renderEditModalName(oldState, newState) {
            if(!_.isEqual(oldState.name, newState.name)) {
                nameDisplay.innerHTML = newState.name;
            }
        }
        store.subscribe(renderEditModalName);

        // -- career-status
        function renderEditModalCareerStatus(oldState, newState) {
            if(!_.isEqual(oldState.field, newState.field)) {
                fieldDisplay.innerHTML = newState.field;
            }
            if(!_.isEqual(oldState.position, newState.position)) {
                positionDisplay.innerHTML = newState.position;
            }
        }
        store.subscribe(renderEditModalCareerStatus);

        // -- whereabouts
        function renderEditModalWhereabouts(oldState, newState) {
            if(!_.isEqual(oldState.location.city, newState.location.city)) {
                cityDisplay.innerHTML = newState.location.city;
            }
            if(!_.isEqual(oldState.location.province, newState.location.province)) {
                provinceDisplay.innerHTML = newState.location.province;
            }
            if(!_.isEqual(oldState.location.country, newState.location.country)) {
                countryDisplay.innerHTML = newState.location.country;
            }
            if(!_.isEqual(oldState.location.area_code, newState.location.areaCode)) {
                areaCodeDisplay.innerHTML = newState.location.area_code;
            }
        }
        store.subscribe(renderEditModalWhereabouts);
        
        // -- name form
        function renderNameForm(oldState, newState) {
            if(!_.isEqual(oldState.showNameEdit, newState.showNameEdit)) {
                if (newState.showNameEdit) {
                    nameForm.style.display = 'block';
                    nameForm.elements['name'].value = nameDisplay.innerHTML;
                    nameDisplayWrapper.style.display = 'none';
                } else {
                    nameForm.style.display = 'none';
                    nameDisplayWrapper.style.display = 'block';
                }
            }
        }
        store.subscribe(renderNameForm);

        // -- career-status form
        function renderCareerStatusForm(oldState, newState) {
            if(!_.isEqual(oldState.showCareerStatusEdit, newState.showCareerStatusEdit)) {
                if (newState.showCareerStatusEdit) {
                    careerStatusFormWrapper.style.display = 'block';
                    fieldForm.elements['field'].value = fieldDisplay.innerHTML;
                    positionForm.elements['position'].value = positionDisplay.innerHTML;
                    careerStatusDisplayWrapper.style.display = 'none';
                } else {
                    careerStatusFormWrapper.style.display = 'none';
                    careerStatusDisplayWrapper.style.display = 'block';
                }
            }
        }
        store.subscribe(renderCareerStatusForm);

        // -- whereabouts form
        function renderWhereaboutsForm(oldState, newState) {
            if(!_.isEqual(oldState.showWhereaboutsEdit, newState.showWhereaboutsEdit)) {
                if (newState.showWhereaboutsEdit) {
                    whereaboutsForm.style.display = 'block';
                    whereaboutsForm.elements['city'].value = cityDisplay.innerHTML;
                    whereaboutsForm.elements['province'].value = provinceDisplay.innerHTML;
                    whereaboutsForm.elements['area_code'].value = areaCodeDisplay.innerHTML;
                    whereaboutsForm.elements['country'].value = countryDisplay.innerHTML;
                    whereaboutsDisplayWrapper.style.display = 'none';
                } else {
                    whereaboutsForm.style.display = 'none';
                    whereaboutsDisplayWrapper.style.display = 'block';
                }
            }
        }
        store.subscribe(renderWhereaboutsForm);


    }//EditProfileModal
    EditProfileModal();


</script>