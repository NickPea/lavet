{{--  --}}



<style>


</style>



{{-- ---------------------------------------------------------------------------- --}}



<div class="content-wrapper">

    <!-- title & options -->
    <div class="d-flex mb-2">

        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">
            Experience
            (<span data-js="profile-experience-count">
                <!-- count -->
            </span>)
        </h5>

        <!-- options -->
        <div class="btn-group ml-auto">
            <!-- add -->
            <a data-js="profile-experience-add-button" class="options-button">
                @include('svg.add')
            </a>
        </div>

    </div>



    <!-- ---------------------------------------------------------------------------- -->



    {{-- DISPLAY --}}

    <div data-js="profile-experience-display-wrapper">

        <div data-js="profile-experience-display">
            {{-- entry --}}
        </div>

    </div>




    <!-- ----------------------------------------------------------------------------- -->



    {{-- HIDDEN FORM / ADD --}}

    <div data-js="profile-experience-add-form-wrapper" style="display: none">

        <div class="card">
            <div class="card-body">

                <!-- current position -->
                <div class="mb-2 form-check">
                    <input data-js="profile-experience-add-form-current-check" class="form-check-input" type="checkbox"
                        name="current_position">
                    <label class="form-check-label" for="defaultCheck1">
                        Current position
                    </label>
                </div>

                <form data-js="profile-experience-add-form">

                    <!-- tokens -->
                    @csrf

                    <!-- role -->
                    <div class="form-group">
                        <label class="sr-only" for="work_role">Role</label>
                        <input class="form-control form-control-lg" type="text" name="work_role" id="work_role"
                            placeholder="Role" required>
                    </div>

                    <!-- organisation -->
                    <div class="form-group">
                        <label class="sr-only" for="organisation">Organisation</label>
                        <input class="form-control form-control-lg" type="text" name="organisation" id="organisation"
                            placeholder="Organisation" required>
                    </div>

                    <div class="row">

                        <!-- from -->
                        <div class="form-group col-6">
                            <label for="start_at">
                                <h5 class="font-weight-bold text-secondary ml-3 m-0">
                                    From
                                </h5>
                            </label>
                            <input class="form-control form-control-lg" type="month" name="start_at" id="start_at"
                                placeholder="Started" required>
                        </div>

                        <!-- to -->
                        <div data-js="profile-experience-add-form-date-to" class="form-group col-6">
                            <label for="end_at">
                                <h5 class="font-weight-bold text-secondary ml-3 m-0">
                                    To
                                </h5>
                            </label>
                            <input class="form-control form-control-lg" type="month" name="end_at" id="end_at"
                                placeholder="Ended">
                        </div>

                    </div>

                    <!-- buttons -->

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button data-js="profile-experience-add-form-cancel" type="reset"
                            class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                        <button class="ml-2 btn btn-primary btn-lg">save</button>
                    </div>

                </form>

            </div><!-- //card-body -->
        </div><!-- //card -->


    </div><!-- //form-wrapper -->

    <!-- ------------------------------------------------------------------------------ -->
    
    
    {{-- HIDDEN FORM / EDIT --}}

    <div data-js="profile-experience-edit-form-wrapper" style="display: none">

        <div class="card">
            <div class="card-body">

                <!-- current position -->
                <div class="mb-2 form-check">
                    <input data-js="profile-experience-edit-form-current-check" class="form-check-input" type="checkbox"
                        name="current_position">
                    <label class="form-check-label" for="defaultCheck1">
                        Current position
                    </label>
                </div>

                <form data-js="profile-experience-edit-form">

                    <!-- tokens -->
                    @csrf
                    @method('PUT')

                    <!-- id -->
                    <input type="hidden" name="id">

                    <!-- role -->
                    <div class="form-group">
                        <label class="sr-only" for="work_role">Role</label>
                        <input class="form-control form-control-lg" type="text" name="work_role" id="work_role"
                            placeholder="Role" required>
                    </div>

                    <!-- organisation -->
                    <div class="form-group">
                        <label class="sr-only" for="organisation">Organisation</label>
                        <input class="form-control form-control-lg" type="text" name="organisation" id="organisation"
                            placeholder="Organisation" required>
                    </div>

                    <div class="row">

                        <!-- from -->
                        <div class="form-group col-6">
                            <label for="start_at">
                                <h5 class="font-weight-bold text-secondary ml-3 m-0">
                                    From
                                </h5>
                            </label>
                            <input class="form-control form-control-lg" type="month" name="start_at" id="start_at"
                                placeholder="Started" required>
                        </div>

                        <!-- to -->
                        <div data-js="profile-experience-edit-form-date-to" class="form-group col-6">
                            <label for="end_at">
                                <h5 class="font-weight-bold text-secondary ml-3 m-0">
                                    To
                                </h5>
                            </label>
                            <input class="form-control form-control-lg" type="month" name="end_at" id="end_at"
                                placeholder="Ended">
                        </div>

                    </div>

                    <!-- buttons -->

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button data-js="profile-experience-edit-form-cancel" type="reset"
                            class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                        <button class="ml-2 btn btn-primary btn-lg">save</button>
                    </div>

                </form>

            </div><!-- //card-body -->
        </div><!-- //card -->


    </div><!-- //form-wrapper -->
    
    
    <!-- ------------------------------------------------------------------------------ -->


</div><!-- //content-wrapper -->


{{-- ---------------------------------------------------------------------------- --}}

<script>
    "use strict"

     function ProfileExperience() {
         

        //DOM

        let experienceCount = document.querySelector('[data-js="profile-experience-count"]')
        let experienceDisplayWrapper = document.querySelector('[data-js="profile-experience-display-wrapper"]')
        let experienceDisplay = document.querySelector('[data-js="profile-experience-display"]')
        let experienceAddButton = document.querySelector('[data-js="profile-experience-add-button"]')
        
        let experienceAddFormWrapper = document.querySelector('[data-js="profile-experience-add-form-wrapper"]')
        let experienceAddForm = document.querySelector('[data-js="profile-experience-add-form"]')
        let experienceAddFormCurrentCheck = document.querySelector('[data-js="profile-experience-add-form-current-check"]')
        let experienceAddFormDateTo = document.querySelector('[data-js="profile-experience-add-form-date-to"]')
        let experienceAddFormCancel = document.querySelector('[data-js="profile-experience-add-form-cancel"]')
        
        let experienceEditFormWrapper = document.querySelector('[data-js="profile-experience-edit-form-wrapper"]')
        let experienceEditForm = document.querySelector('[data-js="profile-experience-edit-form"]')
        let experienceEditFormCurrentCheck = document.querySelector('[data-js="profile-experience-edit-form-current-check"]')
        let experienceEditFormDateTo = document.querySelector('[data-js="profile-experience-edit-form-date-to"]')
        let experienceEditFormCancel = document.querySelector('[data-js="profile-experience-edit-form-cancel"]')

        !experienceCount && console.error('dom query not found');
        !experienceDisplayWrapper && console.error('dom query not found');
        !experienceDisplay && console.error('dom query not found');
        !experienceAddButton && console.error('dom query not found');
        
        !experienceAddFormWrapper && console.error('dom query not found');
        !experienceAddForm && console.error('dom query not found');
        !experienceAddFormCurrentCheck && console.error('dom query not found');
        !experienceAddFormDateTo && console.error('dom query not found');
        !experienceAddFormCancel && console.error('dom query not found');
        
        !experienceEditFormWrapper && console.error('dom query not found');
        !experienceEditForm && console.error('dom query not found');
        !experienceEditFormCurrentCheck && console.error('dom query not found');
        !experienceEditFormDateTo && console.error('dom query not found');
        !experienceEditFormCancel && console.error('dom query not found');

        //EVENTS

        // show add form
        experienceAddButton.addEventListener('click', () => {
            store.publish({type: 'profile-experience-add-form/toggle'})
        });
        // cancel add form
        experienceAddFormCancel.addEventListener('click', () => {
            store.publish({type: 'profile-experience-add-form/toggle'})
            store.publish({type: 'profile-experience-add-form-is-current/off'});
            experienceAddFormCurrentCheck.checked = false;

        });
        // check current on add form
        experienceAddFormCurrentCheck.addEventListener('change', () => {
            store.publish({type: 'profile-experience-add-form-is-current/toggle'});
        });

        //submit add form
        experienceAddForm.addEventListener('submit', async () => {
            event.preventDefault();
            await storeProfileExperience(experienceAddForm);
            refreshProfileExperience();
            store.publish({type: 'profile-experience-add-form/toggle'});
            store.publish({type: 'profile-experience-add-form-is-current/off'});
            experienceAddFormCurrentCheck.checked = false;
        });

        // cancel edit form
        experienceEditFormCancel.addEventListener('click', () => {
            store.publish({type: 'profile-experience-edit-form/toggle'})
            store.publish({type: 'profile-experience-edit-form-is-current/off'});
            experienceEditFormCurrentCheck.checked = false;
        });

        // check current on edit form
        experienceEditFormCurrentCheck.addEventListener('change', () => {
            store.publish({type: 'profile-experience-edit-form-is-current/toggle'});
        });

        //submit edit form
        experienceEditForm.addEventListener('submit', async () => {
            event.preventDefault();
            await updateProfileExperience(experienceEditForm);
            refreshProfileExperience();
            store.publish({type: 'profile-experience-edit-form/toggle'});
            store.publish({type: 'profile-experience-edit-form-is-current/off'});
            experienceEditFormCurrentCheck.checked = false;
        });


        //RENDER

        // toggle current display on add form
        function renderExperienceAddFormCurrentDisplay(oldState, newState) {
            if (!_.isEqual(oldState.experienceAddFormIsCurrent, newState.experienceAddFormIsCurrent)) {
                if (newState.experienceAddFormIsCurrent) {
                    experienceAddFormDateTo.style.display = 'none';
                } else {
                    experienceAddFormDateTo.style.display = 'block';
                }
            }
        }
        store.subscribe(renderExperienceAddFormCurrentDisplay);


        // render add form
        function renderExperienceAddForm(oldState, newState) {
            if (!_.isEqual(oldState.showExperienceAddForm, newState.showExperienceAddForm)) {
                if (newState.showExperienceAddForm) {
                    experienceAddFormWrapper.style.display = 'block';
                    experienceDisplayWrapper.style.display = 'none';
                } else {
                    experienceAddFormWrapper.style.display = 'none';
                    experienceDisplayWrapper.style.display = 'block';
                }
            }
        }
        store.subscribe(renderExperienceAddForm);


        // toggle current display on edit form
        function renderExperienceEditFormCurrentDisplay(oldState, newState) {
            if (!_.isEqual(oldState.experienceEditFormIsCurrent, newState.experienceEditFormIsCurrent)) {
                if (newState.experienceEditFormIsCurrent) {
                    experienceEditFormDateTo.style.display = 'none';
                } else {
                    experienceEditFormDateTo.style.display = 'block';
                }
            }
        }
        store.subscribe(renderExperienceEditFormCurrentDisplay);


        // render edit form
        function renderExperienceEditForm(oldState, newState) {
            if (!_.isEqual(oldState.showExperienceEditForm, newState.showExperienceEditForm)) {
                if (newState.showExperienceEditForm) {
                    experienceEditFormWrapper.style.display = 'block';
                    experienceDisplayWrapper.style.display = 'none';
                } else {
                    experienceEditFormWrapper.style.display = 'none';
                    experienceDisplayWrapper.style.display = 'block';
                }
            }
        }
        store.subscribe(renderExperienceEditForm);


        //count render
        function renderExperienceCount(oldState, newState) {
            if (!_.isEqual(oldState.experience.count, newState.experience.count)) {
                    experienceCount.textContent = newState.experience.count
            }
        }
        store.subscribe(renderExperienceCount);


        //items render
        function renderExperience(oldState, newState) {
            if (!_.isEqual(oldState.experience.items, newState.experience.items)) {
                //1. map data to create list
                let mappedExperience = newState.experience.items.map(expItem => {
                    return (`
                        <div data-js="profile-experience-display-item">
                            <div class="card rounded-lg">
                                <div class="card-body">
                                    <div class="row">

                                        <!-- col1 / icon -->
                                        <div class="col-1">

                                            @include('svg.experience')

                                        </div>

                                        <!-- col 2 / details -->
                                        <div class="col">

                                            <!-- inner row -->
                                            <div class="row">
                                                <div class="col">

                                                    <div class="d-flex align-items-center">

                                                        <h5 class="d-inline m-0">
                                                            <span>${expItem.work_role}</span>
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <span class="text-muted ">at</span>
                                                        <span class="d-inline">
                                                            <span>
                                                                <span>${expItem.organisation}</span>
                                                            </span>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- inner row -->
                                            <div class="row">
                                                <div class="col">

                                                    <span>${expItem.start_at}</span>
                                                    <span>to</span>
                                                    <span>${expItem.end_at}</span>

                                                </div>
                                            </div>

                                        </div>

                                        <!-- col3 / options -->
                                        <div class="col-2">
                                            <div class="d-flex justify-content-end">


                                                    <div class="btn-group">
                                                    <a href="" class="options-button" data-toggle="dropdown">
                                                        @include('svg.more')
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-js="profile-experience-dropdown-edit" class="dropdown-item font-weight-bold">
                                                            Edit
                                                        </a>
                                                        <a data-js="profile-experience-dropdown-remove" class="dropdown-item font-weight-bold">
                                                            Remove
                                                        </a>
                                                    </div>
                                                </div>


                                            </div><!-- //flex -->
                                        </div>

                                        <form data-js="profile-experience-item-hidden-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="${expItem.id}">
                                        </form>
                                        <form data-js="profile-experience-item-hidden-data-form">
                                            <input type="hidden" name="id" value="${expItem.id}">
                                            <input type="hidden" name="work_role" value="${expItem.work_role}">
                                            <input type="hidden" name="organisation" value="${expItem.organisation}">
                                            <input type="hidden" name="start_at" value="${expItem.start_at}">
                                            <input type="hidden" name="end_at" value="${expItem.end_at}">
                                        </form>


                                    </div><!-- outter row -->
                                </div><!-- //card-body -->
                            </div><!-- //card --> 
                        </div><!-- //data-js="profile-experience-display-items" -->  
                    `)
                });
                //2. append to entry
                experienceDisplay.innerHTML = mappedExperience.join('');

                //3. add event listeners
                let experienceDisplayItems = experienceDisplay.querySelectorAll('[data-js="profile-experience-display-item"]')
                !experienceDisplayItems && console.error('dom query not found');
                experienceDisplayItems.forEach((expItem) => {
                    
                    //DOM
                    let expItemHiddenDataForm = expItem.querySelector('[data-js="profile-experience-item-hidden-data-form"]');
                    let expItemHiddenDeleteForm = expItem.querySelector('[data-js="profile-experience-item-hidden-delete-form"]');
                    let expItemEditButton = expItem.querySelector('[data-js="profile-experience-dropdown-edit"]');
                    let expItemRemoveButton = expItem.querySelector('[data-js="profile-experience-dropdown-remove"]');
                    !expItemHiddenDataForm && console.error('dom query not found');
                    !expItemHiddenDeleteForm && console.error('dom query not found');
                    !expItemEditButton && console.error('dom query not found');
                    !expItemRemoveButton && console.error('dom query not found');

                    //EVENTS
                    // -- prevent default submits
                    expItemHiddenDataForm.onsubmit = (event) => {event.preventDefault()}
                    expItemHiddenDeleteForm.onsubmit = (event) => {event.preventDefault()}

                    // -- delete/remove credential
                    expItemRemoveButton.addEventListener('click', async () => {
                        await destroyProfileExperience(expItemHiddenDeleteForm);
                        refreshProfileExperience();
                    });

                    // --  show edit form and fill with hidden credential data
                    expItemEditButton.addEventListener('click', () => {

                        experienceEditForm.elements['id'].value = expItemHiddenDataForm.elements['id'].value;
                        experienceEditForm.elements['work_role'].value = expItemHiddenDataForm.elements['work_role'].value;
                        experienceEditForm.elements['organisation'].value = expItemHiddenDataForm.elements['organisation'].value;
                        experienceEditForm.elements['start_at'].value = expItemHiddenDataForm.elements['start_at'].value;
                        experienceEditForm.elements['end_at'].value = expItemHiddenDataForm.elements['end_at'].value;
                        store.publish({type: 'profile-experience-edit-form/toggle'})

                    });


                });//foreach
            }//if
        }
        store.subscribe(renderExperience)


     }
     ProfileExperience();



</script>