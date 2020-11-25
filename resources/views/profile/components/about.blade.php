{{--  --}}


<style>


</style>



{{-- ------------------------------------------------------------------------------------ --}}



<div data-js="profile-about-wrapper" class="content-wrapper">

    <!-- title & options -->
    <div class="d-flex mb-2">

        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">Bio</h5>

        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a data-js="profile-about-edit-button" class="options-button">
                @include('svg.edit')
            </a>
        </div>

    </div>

    <!-- ---------------------------------------------------------------------------- -->

    {{-- DISPLAY --}}
    <div data-js="profile-about-display-wrapper">
        <div class="card">
            <div class="card-body">
                <p data-js="profile-about-display" class="m-0">
                    {{-- entry --}}
                </p>
            </div>
        </div>
    </div>

    <!-- ---------------------------------------------------------------------------- -->

    {{-- HIDDEN FORM --}}
    <form data-js="profile-about-form" style="display: none">
        @csrf
        @method('PUT')

        <div class="d-flex flex-column">

            <!-- about -->
            <div class="form-group">
                <label class="sr-only" for="about">Edit profile about</label>
                <textarea name="about" id="about" rows="4" class="form-control"></textarea>
            </div>

            <!-- buttons -->
            <span class="align-self-end">
                <button data-js="profile-about-form-cancel" class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                <button class="btn btn-primary btn-lg">save</button>
            </span>

        </div>
    </form>

</div><!-- //content-wrapper -->




{{-- ------------------------------------------------------------------------------------ --}}



<script>
    "use strict"
    
    function ProfileAbout() {
        //DOM

        let profileAboutWrapper = document.querySelector('[data-js="profile-about-wrapper"]')
        let editAboutButton = document.querySelector('[data-js="profile-about-edit-button"]')
        let aboutDisplayWrapper = document.querySelector('[data-js="profile-about-display-wrapper"]')
        let aboutDisplay = document.querySelector('[data-js="profile-about-display"]')
        let aboutForm = document.querySelector('[data-js="profile-about-form"]')
        let aboutFormCancel = document.querySelector('[data-js="profile-about-form-cancel"]')

        !editAboutButton && console.error('dom query not found')
        !aboutDisplayWrapper && console.error('dom query not found')
        !aboutDisplay && console.error('dom query not found')
        !aboutDisplay && console.error('dom query not found')
        !aboutForm && console.error('dom query not found')
        !aboutFormCancel && console.error('dom query not found')


        //EVENTS

        //show form on edit click
        editAboutButton.addEventListener('click', () => {
            store.publish({type: 'profile-about-form/toggle'})
        });
        //hide form on cancel
        aboutFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-about-form/toggle'})
        });
        //submit
        aboutForm.addEventListener('submit', async () => {
            event.preventDefault();
            await updateProfileAbout(aboutForm);
            refreshProfileAbout();
            store.publish({type: 'profile-about-form/toggle'})
        });



        //RENDER

        function renderAbout(oldState, newState) {
            if (!_.isEqual(oldState.about, newState.about)) {
                aboutDisplay.innerHTML = newState.about;
            }
        }
        store.subscribe(renderAbout);

        function renderAboutForm(oldState, newState) {
            if (!_.isEqual(oldState.showAboutForm, newState.showAboutForm)) {
                if (newState.showAboutForm) {
                    aboutDisplayWrapper.style.display = 'none';
                    aboutForm.elements['about'].value = aboutDisplay.innerHTML;
                    aboutForm.style.display = 'block';
                    aboutForm.elements['about'].focus();
                } else {
                    aboutDisplayWrapper.style.display = 'block';
                    aboutForm.style.display = 'none';
                }
            }
        }
        store.subscribe(renderAboutForm);

        




    }
    ProfileAbout();






</script>