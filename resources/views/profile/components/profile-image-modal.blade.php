{{--  --}}

<style>
    .profile-image-modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        /* overflow: auto; */
        background-color: rgba(0, 0, 0, 0.4);
    }

    .profile-image-modal-content {
        background-color: #fefefe;
        margin-left: auto;
        margin-right: 10rem;
        width: 50%;
        padding: 1rem;
        object-fit: cover
    }

    .profile-modal-images:hover {
        filter: brightness(90%);
    }

    .profile-modal-image-selected {
        box-shadow: 0 0 1px 4px rgba(135, 206, 250, 0.8);
    }

    /* move up to app layouts eventually */
    .hidden-input {
        position: absolute;
        overflow: hidden;
        clip: rect(0 0 0 0);
        height: 1px;
        width: 1px;
        margin: -1px;
        padding: 0;
        border: 0;
    }
</style>

{{-- ------------------------------------------------------------------------------------- --}}

<div>

    <!-- Trigger/Open The Modal -->
    {{-- <button id="myBtn">Open Modal</button> --}}

    <!-- The Modal -->
    <div data-js="profile-image-modal" class="profile-image-modal">

        <!-- Modal content -->
        <div class="profile-image-modal-content rounded-lg">

            {{-- corner close button--}}
            <span data-js="profile-image-modal-close-button" class="options-button"
                style="position: absolute; right:3rem; top:3rem; transform:scale(1.5,1.5);">
                @include('svg.close')
            </span>

            {{-- header --}}
            <div class="d-flex justify-content-center">
                <h4 class="m-0 d-inline">Update Profile Photo</h4>
            </div>

            <hr><!-- break -->

            <div data-js="profile-image-entry" class="row no-gutters" style="max-height:50vh; overflow:auto;">
                {{-- user images --}}
            </div>

            <hr><!-- break -->

            <form data-js="profile-image-modal-form">
                @csrf
                @method('PUT')
                <!-- hidden input -->
                <input data-js="profile-image-modal-hidden-input" type="text" name="selected_image" class="hidden-input" required>

                <div class="d-flex justify-content-end">
                    <button data-js="profile-image-modal-cancel"
                        class="btn btn-outline-secondary btn-lg">cancel</button>
                    <button class="ml-2 btn btn-primary btn-lg" type="submit">save</button>
                </div>
            </form>

        </div>

    </div>

</div>

{{-- ------------------------------------------------------------------------------------- --}}

<script>
    'use strict'

    function ProfileImageModal() {
       
        //dom
        let modal = document.querySelector('[data-js="profile-image-modal"]');
        let closeButton = document.querySelector('[data-js="profile-image-modal-close-button"]');
        let profileImageEntry = document.querySelector('[data-js="profile-image-entry"]');
        let profileImageModalForm = document.querySelector('[data-js="profile-image-modal-form"]');
        let profileImageModalCancel = document.querySelector('[data-js="profile-image-modal-cancel"]');
        let profileImageModalHiddenInput = document.querySelector('[data-js="profile-image-modal-hidden-input"]');
        
        //dom-check
        !modal && console.error('modal not found');
        !closeButton && console.error('close not found');
        !profileImageEntry && console.error('profile image select not found')
        !profileImageModalForm && console.error('profile image modal form not found')
        !profileImageModalCancel && console.error('profile image modal cancel not found')
        !profileImageModalHiddenInput && console.error('profile image modal hidden input not found')

        //events
        closeButton.onclick = function() {
            store.publish({type: 'profile-image-modal/toggle'})
            document.querySelectorAll('[data-js="profile-image-entry"] img')
                .forEach(img => {
                img.classList.remove('profile-modal-image-selected');
                profileImageModalHiddenInput.value = null;
                });
                    };
        //close on outside click
        window.onclick = function(event) {
            if (event.target == modal) {
                store.publish({type: 'profile-image-modal/toggle'});
                document.querySelectorAll('[data-js="profile-image-entry"] img')
                .forEach(img => {
                img.classList.remove('profile-modal-image-selected');
                profileImageModalHiddenInput.value = null;
                });
            }
        };

        profileImageModalCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type:'profile-image-modal/toggle'})
            document.querySelectorAll('[data-js="profile-image-entry"] img')
                .forEach(img => {
                img.classList.remove('profile-modal-image-selected');
                profileImageModalHiddenInput.value = null;
                });
        });

        //subscribe modal render and fetch images
        function renderModal(oldState, newState) {
            if(!_.isEqual(oldState.showProfileImageModal, newState.showProfileImageModal)) {
                console.log('profile image modal rendering')
                if(newState.showProfileImageModal) {
                    modal.style.display = "block"
                    fetchAndStoreModalImages();
                } else {
                    modal.style.display = "none"
                }
            }//endif
        }//renderModal
        store.subscribe(renderModal);

        //fetch modal images and update store
        function fetchAndStoreModalImages(params) {
            let url = new URL(`${window.location.href}?section=user-images`);
            fetch(url)
            .then(res => {
                switch (res.status) {
                    case 200 :
                        res.json().then(arrayOfImageObjects => {
                            store.publish({type: 'profile-image-modal/update-data', payload: arrayOfImageObjects })
                        });
                        break;
                    default:
                        console.error(`Profile-Image-Select - Fetch Error: ${res.status}`);
                        break;
                }//switch
            })//then
        }//fetchAndStoreModalImages


        //subscribe modal-image render
        function renderModalImages(oldState, newState) {
            if(!_.isEqual(oldState.profileModalImages, newState.profileModalImages)) {
                console.log('user images rendering')
                //1. append the the entry div
                profileImageEntry.innerHTML = newState.profileModalImages.map((imgObj) => {
                    return(`
                        <span class="col-3 p-1">
                            <img src="${imgObj.path}" data-id="${imgObj.id}" 
                            class="profile-modal-images img-thumbnail p-0">
                        </span>
                    `)
                }).join('');//endMap
                //2. add event listeners to all the images
                let modalImages = document.querySelectorAll('[data-js="profile-image-entry"] img')
                modalImages.forEach(img => {
                    img.addEventListener('click', () => {
                        modalImages.forEach(img => img.classList.remove('profile-modal-image-selected'));
                        img.classList.add('profile-modal-image-selected');
                        profileImageModalHiddenInput.value = img.dataset.id;
                    });
                })
            }//endIf
        }//renderModalImages
        store.subscribe(renderModalImages);


        function fetchAndStoreProfileImage() {
            let url = new URL(`${window.location.href}?section=profile-image`)
            fetch(url)
            .then(res => {
                switch (res.status) {
                    case 200 :
                        res.json().then(profileImageObj => {
                            store.publish({type: 'profile-image/update-data', payload: profileImageObj })
                        });
                        break;
                    default:
                        console.error(`Profile-Image-Update - Fetch Error: ${res.status}`);
                        break;
                }//switch
            })//then            
        }//fetchAndStoreProfileImage


        profileImageModalForm.addEventListener('submit', () => {
            event.preventDefault();
            //todo: custom form validation
            let formData = new FormData(profileImageModalForm)
            let url = new URL(`${window.location.href}/profile-image`);
            fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(res => {
                switch (res.status) {
                    case 200 :
                        res.json().then( obj => {
                            console.log(`profile image updated: ${JSON.stringify(obj)}`);
                            //update store
                            store.publish({type:'profile-image-modal/toggle'});
                            //close and reset modal
                            document.querySelectorAll('[data-js="profile-image-entry"] img')
                                .forEach( img => {
                                img.classList.remove('profile-modal-image-selected');
                                profileImageModalHiddenInput.value = null;
                                });
                        })
                        .then(() => fetchAndStoreProfileImage());
                        break;
                    default:
                        throw res;
                        break;
                }//switch
            }).catch(res => console.error(`Modal fetch error: status - ${res.status}`));
        });//modal submit
        

        //ADD NEW IMAGE UPLOAD FUNCATIONALITY THNE CALL FETCH AND STORE IMAGES


    }//ProfileImageModal
    ProfileImageModal();

    

</script>