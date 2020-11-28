{{--  --}}



<style>



</style>



{{-- ------------------------------------------------------------------------------- --}}



<div class="content-wrapper">


    <!-- title -->
    <div class="d-flex mb-2">

        <h5 class="font-weight-light" style="color:grey">
            Credentials
            (<span data-js="profile-credential-count">
                <!-- credential count -->
            </span>)
        </h5>

        <!-- options -->
        <div class="btn-group ml-auto">
            <a data-js="profile-credential-add-button" class="options-button">
                @include('svg.add')
            </a>
        </div>

    </div>


    <!-- -------------------------------------------------------------------------------------------------- -->


    {{-- DISPLAY --}}
    <div data-js="profile-credential-display-wrapper">
        <div data-js="profile-credential-display" class="row">

            {{-- entry --}}

        </div>
    </div>


    <!-- -------------------------------------------------------------------------------------------------- -->


    {{-- HIDDEN FORM (ADD) --}}
    <div data-js="profile-credential-add-form-wrapper" class="mt-3" style="display: none">

        <div class="row">
            <div class="col">
                <div class="card rounded-lg">
                    <div class="card-body">

                        <div class="card-title">
                            <h6>Add a credential.</h6>
                        </div>

                        <form data-js="profile-credential-add-form">
                            <!-- tokens -->
                            @csrf

                            <!-- name -->
                            <div class="form-group">
                                <label for="name" class="sr-only">Certificate</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    placeholder="Certificate">
                            </div>

                            <!-- institution -->
                            <div class="form-group">
                                <label for="institution" class="sr-only">Institution</label>
                                <input type="text" name="institution" id="institution"
                                    class="form-control form-control-lg" placeholder="Institution">
                            </div>

                            <!-- end_year -->
                            <div class="form-group">
                                <label for="end_year" class="sr-only">Finish Year</label>
                                <select class="form-control form-control-lg" name="end_year" id="end_year">
                                    <option value="" selected>Finish Year</option>
                                </select>
                            </div>

                            <!-- buttons -->
                            <span class="d-flex justify-content-end">
                                <button data-js="profile-credential-add-form-cancel"
                                    class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                                <button class="btn btn-primary btn-lg ml-2">add</button>
                            </span>

                        </form>
                    </div><!-- //card-body -->
                </div><!-- //card -->
            </div>
        </div>
    </div><!-- //form-wrapper -->

    <!-- -------------------------------------------------------------------------------------------------- -->

    {{-- HIDDEN FORM (EDIT) --}}

    <div data-js="profile-credential-edit-form-wrapper" class="mt-3" style="display: none">


        <div class="row">
            <div class="col">
                <div class="card rounded-lg">
                    <div class="card-body">

                        <div class="card-title">
                            <h6>Edit Credential.</h6>
                        </div>

                        <form data-js="profile-credential-edit-form">
                            <!-- tokens -->
                            @csrf
                            @method('PUT')

                            <!-- id -->
                            <input type="hidden" name="id">

                            <!-- name -->
                            <div class="form-group">
                                <label for="name" class="sr-only">Certificate</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    placeholder="Certificate">
                            </div>

                            <!-- institution -->
                            <div class="form-group">
                                <label for="institution" class="sr-only">Institution</label>
                                <input type="text" name="institution" id="institution"
                                    class="form-control form-control-lg" placeholder="Institution">
                            </div>

                            <!-- end_year -->
                            <div class="form-group">
                                <label for="end_year" class="sr-only">Finish Year</label>
                                <select class="form-control form-control-lg" name="end_year" id="end_year">
                                    <option value="" selected>Finish Year</option>
                                </select>
                            </div>

                            <!-- buttons -->
                            <span class="d-flex justify-content-end">
                                <button data-js="profile-credential-edit-form-cancel"
                                    class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                                <button class="btn btn-primary btn-lg ml-2">save</button>
                            </span>

                        </form>
                    </div><!-- //card-body -->
                </div><!-- //card -->
            </div>
        </div>
    </div><!-- //edit-form-wrapper -->

</div><!-- //content-wrapper -->




{{-- ------------------------------------------------------------------------------- --}}



<script>
    function Credential() {

        //DOM


        let credentialCount = document.querySelector('[data-js="profile-credential-count"]');
        let credentialAddButton = document.querySelector('[data-js="profile-credential-add-button"]');
        let credentialDisplayWrapper = document.querySelector('[data-js="profile-credential-display-wrapper"]');
        let credentialDisplay = document.querySelector('[data-js="profile-credential-display"]');

        let credentialAddFormWrapper = document.querySelector('[data-js="profile-credential-add-form-wrapper"]');
        let credentialAddForm = document.querySelector('[data-js="profile-credential-add-form"]');
        let credentialAddFormCancel = document.querySelector('[data-js="profile-credential-add-form-cancel"]');
        let credentialAddFormSelect = credentialAddForm.elements['end_year'];
        
        let credentialEditFormWrapper = document.querySelector('[data-js="profile-credential-edit-form-wrapper"]');
        let credentialEditForm = document.querySelector('[data-js="profile-credential-edit-form"]');
        let credentialEditFormCancel = document.querySelector('[data-js="profile-credential-edit-form-cancel"]');
        let credentialEditFormSelect = credentialEditForm.elements['end_year'];

        !credentialCount && console.error('dom query not found');
        !credentialAddButton && console.error('dom query not found');
        !credentialDisplayWrapper && console.error('dom query not found');
        !credentialDisplay && console.error('dom query not found');

        !credentialAddFormWrapper && console.error('dom query not found');
        !credentialAddForm && console.error('dom query not found');
        !credentialAddFormCancel && console.error('dom query not found');
        !credentialAddFormSelect && console.error('dom query not found');
        
        !credentialEditFormWrapper && console.error('dom query not found');
        !credentialEditForm && console.error('dom query not found');
        !credentialEditFormCancel && console.error('dom query not found');
        !credentialEditFormSelect && console.error('dom query not found');


        //EVENTS

        //show add form on add button click
        credentialAddButton.addEventListener('click', () => {
            store.publish({type: 'profile-credential-add-form/toggle'})
        });

        //close add form on cancel 
        credentialAddFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-credential-add-form/toggle'});
        });

        //submit add form
        credentialAddForm.addEventListener('submit', async () => {
            event.preventDefault();
            await storeProfileCredential(credentialAddForm);
            refreshProfileCredential();
            store.publish({type: 'profile-credential-add-form/toggle'});
            [...credentialAddForm.elements].forEach(elem => {
                if (elem.name != '_token') {
                    elem.value = ""
                }
            });
        });

        //close edit form on cancel 
        credentialEditFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-credential-edit-form/toggle'});
        });


        //submit edit form
        credentialEditForm.addEventListener('submit', async () => {
            event.preventDefault();
            await updateProfileCredential(credentialEditForm);
            refreshProfileCredential();
            store.publish({type: 'profile-credential-edit-form/toggle'});
            //wipe form data but spare csrf token
            
        });
        
        //RENDER
        
        //count render
        function renderCredentialCount(oldState, newState) {
            if (!_.isEqual(oldState.credential.count, newState.credential.count)) {
                if (!_.isEqual(oldState.credential.count, newState.credential.count)) {
                    credentialCount.textContent = newState.credential.count
                }
            }
        }
        store.subscribe(renderCredentialCount);

        // add form render
        function renderCredentialAddForm(oldState, newState) {
            if (!_.isEqual(oldState.showCredentialAddForm, newState.showCredentialAddForm)) {
                if (newState.showCredentialAddForm) {
                    credentialAddFormWrapper.style.display = 'block'
                    credentialDisplayWrapper.style.display = 'none'
                } else {
                    credentialAddFormWrapper.style.display = 'none'
                    credentialDisplayWrapper.style.display = 'block'
                }
            }
        }
        store.subscribe(renderCredentialAddForm);

        // edit form render
        function renderCredentialEditForm(oldState, newState) {
            if (!_.isEqual(oldState.showCredentialEditForm, newState.showCredentialEditForm)) {
                if (newState.showCredentialEditForm) {
                    credentialEditFormWrapper.style.display = 'block'
                    credentialDisplayWrapper.style.display = 'none'
                } else {
                    credentialEditFormWrapper.style.display = 'none'
                    credentialDisplayWrapper.style.display = 'block'
                }
            }
        }
        store.subscribe(renderCredentialEditForm);


        // credential items render
        function renderCredentialItems(oldState, newState) {
            if (!_.isEqual(oldState.credential.items, newState.credential.items)) {
                //1. map data to create list
                let mappedCredentials = newState.credential.items.map(cred => {
                    return (`
                        <div class="col-4">
                            <div data-js="profile-credential-display-item">
                                <div class="card rounded-lg " style="height:14rem;">
                                    <div style="position: relative; height:100%">
    
                                        <!-- dropdown -->
                                        <div class="btn-group d-flex justify-content-end pr-2 pt-2">
                                            <a class="options-button" data-toggle="dropdown">
                                                @include('svg.more')
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button data-js="profile-credential-dropdown-edit" class="dropdown-item" type="button">
                                                    <div class="d-flex">
                                                        <span>Edit</span>
                                                        <span class="ml-auto">@include('svg.edit-black')</span>
                                                    </div>
                                                </button>
                                                <button data-js="profile-credential-dropdown-remove" class="dropdown-item" type="button">
                                                    <div class="d-flex">
                                                        <span>Remove</span>
                                                        <span class="ml-auto">@include('svg.remove')</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
    
                                        <!-- cred-body -->
                                        <div class="card-body d-flex flex-column justify-content-between align-items-center text-center h-100">
                                            <h5 class="m-0">${cred.name}</h5>
                                            <small class="">${cred.institution}</small>
                                            <h6 class="m-0">${cred.end_year}</h6>
                                            <form data-js="profile-credential-item-hidden-delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="${cred.id}">
                                            </form>
                                            <form data-js="profile-credential-item-hidden-data-form">
                                                <input type="hidden" name="id" value="${cred.id}">
                                                <input type="hidden" name="name" value="${cred.name}">
                                                <input type="hidden" name="institution" value="${cred.institution}">
                                                <input type="hidden" name="end_year" value="${cred.end_year}">
                                            </form>
                                        </div>

                                    </div><!-- //pos-relative -->
                                </div><!-- //card -->
                            </div>
                        </div>
                    `)
                });
                //2. append to entry
                credentialDisplay.innerHTML = mappedCredentials.join('');

                //3. add event listeners
                let credentialDisplayItems = credentialDisplay.querySelectorAll('[data-js="profile-credential-display-item"]')
                !credentialDisplayItems && console.error('dom query not found');
                credentialDisplayItems.forEach((credItem) => {

                   //DOM 
                   let credItemHiddenDataForm = credItem.querySelector('[data-js="profile-credential-item-hidden-data-form"]');
                   let credItemHiddenDeleteForm = credItem.querySelector('[data-js="profile-credential-item-hidden-delete-form"]');
                   let credItemEditButton = credItem.querySelector('[data-js="profile-credential-dropdown-edit"]');
                   let credItemRemoveButton = credItem.querySelector('[data-js="profile-credential-dropdown-remove"]');
                   !credItemHiddenDataForm && console.error('dom query not found');
                   !credItemHiddenDeleteForm && console.error('dom query not found');
                   !credItemEditButton && console.error('dom query not found');
                   !credItemRemoveButton && console.error('dom query not found');

                    //EVENTS
                    // -- prevent default submits
                    credItemHiddenDataForm.onsubmit = (event) => {event.preventDefault()}
                    credItemHiddenDeleteForm.onsubmit = (event) => {event.preventDefault()}

                    // -- delete/remove credential
                    credItemRemoveButton.addEventListener('click', async () => {
                        await destroyProfileCredential(credItemHiddenDeleteForm);
                        refreshProfileCredential();
                    });

                    // --  show edit form and fill with hidden credential data
                    credItemEditButton.addEventListener('click', () => {

                        credentialEditForm.elements['id'].value = credItemHiddenDataForm.elements['id'].value;
                        credentialEditForm.elements['name'].value = credItemHiddenDataForm.elements['name'].value;
                        credentialEditForm.elements['institution'].value = credItemHiddenDataForm.elements['institution'].value;
                        credentialEditForm.elements['end_year'].value = credItemHiddenDataForm.elements['end_year'].value;
                        store.publish({type: 'profile-credential-edit-form/toggle'})

                        


                    });

                });//forEach

            }//endif
        }
        store.subscribe(renderCredentialItems);

        
        //MISC

        //fill add form select with options of years from 1900 to 2100
        (function fillAddFormSelects() {
            let domFragment = document.createDocumentFragment()
            let rangeOfYears = [...Array(200).keys()].map(num => num + 1900);
            rangeOfYears.forEach((year, i) => {
                var newOption = document.createElement('option');
                newOption.innerHTML = year;
                newOption.value = year;
                domFragment.appendChild(newOption);
            });


            credentialAddFormSelect.appendChild(domFragment);
        })();

        //fill edit form select with options of years from 1900 to 2100
        (function fillEditFormSelects() {
            let domFragment = document.createDocumentFragment()
            let rangeOfYears = [...Array(200).keys()].map(num => num + 1900);
            rangeOfYears.forEach((year, i) => {
                var newOption = document.createElement('option');
                newOption.innerHTML = year;
                newOption.value = year;
                domFragment.appendChild(newOption);
            });


            credentialEditFormSelect.appendChild(domFragment);
        })();

        

    }
    Credential();

          
</script>


{{-- ------------------------------------------------------------------------------- --}}