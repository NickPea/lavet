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


    {{-- HIDDEN FORM --}}
    <div data-js="profile-credential-form-wrapper" class="mt-3" style="display: none">

        <div class="row">
            <div class="col">
                <div class="card rounded-lg">
                    <div class="card-body">

                        <div class="card-title">
                            <h6>Add a credential.</h6>
                        </div>

                        <form data-js="profile-credential-form">
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
                                <button data-js="profile-credential-form-cancel"
                                    class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                                <button class="btn btn-primary btn-lg ml-2">save</button>
                            </span>

                        </form>
                    </div><!-- //card-body -->
                </div><!-- //card -->
            </div>
        </div>


    </div><!-- //form-wrapper -->



</div><!-- //content-wrapper -->




{{-- ------------------------------------------------------------------------------- --}}



<script>
    function Credential() {

        //DOM


        let credentialCount = document.querySelector('[data-js="profile-credential-count"]');
        let credentialAddButton = document.querySelector('[data-js="profile-credential-add-button"]');
        let credentialDisplayWrapper = document.querySelector('[data-js="profile-credential-display-wrapper"]');
        let credentialDisplay = document.querySelector('[data-js="profile-credential-display"]');
        let credentialFormWrapper = document.querySelector('[data-js="profile-credential-form-wrapper"]');
        let credentialForm = document.querySelector('[data-js="profile-credential-form"]');
        let credentialFormCancel = document.querySelector('[data-js="profile-credential-form-cancel"]');
        let credentialFormSelect = credentialForm.elements['end_year'];
        !credentialCount && console.error('dom query not found');
        !credentialAddButton && console.error('dom query not found');
        !credentialDisplayWrapper && console.error('dom query not found');
        !credentialDisplay && console.error('dom query not found');
        !credentialFormWrapper && console.error('dom query not found');
        !credentialForm && console.error('dom query not found');
        !credentialFormCancel && console.error('dom query not found');
        !credentialFormSelect && console.error('dom query not found');


        //EVENTS

        //show form on add button click
        credentialAddButton.addEventListener('click', () => {
            store.publish({type: 'profile-credential-form/toggle'})
        });

        //close on cancel 
        credentialFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-credential-form/toggle'});
        });

        //submit
        credentialForm.addEventListener('submit', async () => {
            event.preventDefault();
            await storeProfileCredential(credentialForm);
            refreshProfileCredential();
            store.publish({type: 'profile-credential-form/toggle'});
        });

        
        //RENDER

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
                                        <div class="btn-group" style="position: absolute; right: 0.5rem; top: 0.5rem;">
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
                                        <div class="card-body d-flex flex-column justify-content-around align-items-center text-center h-100">
                                            <h5 class="m-0">${cred.name}</h5>
                                            <small class="">${cred.institution}</small>
                                            <h6 class="m-0">${cred.end_year}</h6>
                                            <form>
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="credential_id" value="${cred.id}">
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
                   let credItemForm = credItem.querySelector('form');
                   let credItemEdit = credItem.querySelector('[data-js="profile-credential-dropdown-edit"]');
                   let credItemRemove = credItem.querySelector('[data-js="profile-credential-dropdown-remove"]');
                   !credItemForm && console.error('dom query not found');
                   !credItemEdit && console.error('dom query not found');
                   !credItemRemove && console.error('dom query not found');

                    //EVENTS
                    // -- prevent default submit
                    credItemForm.onsubmit = (event) => {event.preventDefault()}
                    // -- remove credential
                    credItemRemove.addEventListener('click', async () => {
                        await destroyProfileCredential(credItemForm);
                        refreshProfileCredential();
                    });
                    // -- edit credential
                    credItemEdit.addEventListener('click', () => {
                        console.error('no listener set up yet')
                    });
                   
                    

                });//forEach

            }//endif
        }
        store.subscribe(renderCredentialItems);

        function renderCredentialCount(oldState, newState) {
            if (!_.isEqual(oldState.credential.count, newState.credential.count)) {
                if (!_.isEqual(oldState.credential.count, newState.credential.count)) {
                    credentialCount.textContent = newState.credential.count
                }
            }
        }
        store.subscribe(renderCredentialCount);


        function renderCredentialForm(oldState, newState) {
            if (!_.isEqual(oldState.showCredentialForm, newState.showCredentialForm)) {
                if (newState.showCredentialForm) {
                    credentialFormWrapper.style.display = 'block'
                    credentialDisplayWrapper.style.display = 'none'
                } else {
                    credentialFormWrapper.style.display = 'none'
                    credentialDisplayWrapper.style.display = 'block'
                }
            }
        }
        store.subscribe(renderCredentialForm);

        //MISC

        //fill form select with options of years from 1900 to 2100
        (function fillFormSelectWithRangeOfYears() {
            let domFragment = document.createDocumentFragment()
            let rangeOfYears = [...Array(200).keys()].map(num => num + 1900);
            rangeOfYears.forEach((year, i) => {
                var newOption = document.createElement('option');
                newOption.innerHTML = year;
                newOption.value = year;
                domFragment.appendChild(newOption);
            });

            credentialFormSelect.appendChild(domFragment);
        })();

    }
    Credential();

          
</script>


{{-- ------------------------------------------------------------------------------- --}}

