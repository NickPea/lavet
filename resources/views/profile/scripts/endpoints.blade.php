{{--  --}}


<script>
    // --GET & REFRESH STORE
// -------------------------------------------------------------------------------------------------

// -- profile image
function refreshProfileImage() {
    let url = new URL(`${window.location.href}/image`)
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => store.publish({type: 'image/refresh', payload: obj }))
                break;
            default:
                throw res
                break;
        }
    }).catch(res => console.error(`refreshProfileImage()`));
}

// --name
function refreshProfileName() {
    let url = new URL(`${window.location.href}/name`)
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => store.publish({type: 'name/refresh', payload: obj }));
                break;
            default:
                throw res
                break;
        }
    }).catch(res => console.error(`refreshProfileName()`));
}

// --field
function refreshProfileField() {
    let url = new URL(`${window.location.href}/field`)
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => store.publish({type: 'field/refresh', payload: obj }));
                break;
            default:
                throw res;
                break;
        }
    }).catch(res => console.error(`refreshProfileField()`));
}

// --position
function refreshProfilePosition() {
    let url = new URL(`${window.location.href}/position`)
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => store.publish({type: 'position/refresh', payload: obj }));
                break;
            default:
                throw res;
                break;
        }
    }).catch(res => console.error(`refreshProfilePosition()`));
}

// --location
function refreshProfileLocation() {
    let url = new URL(`${window.location.href}/location`)
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => store.publish({type: 'location/refresh', payload: obj }));
                break;
            default:
                throw res;
                break;
        }
    }).catch(res => console.error(`refreshProfileLocation()`));
}

// -- user images
function refreshProfileUserImages() {
    let url = new URL(`${window.location.href}/user-images`);
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(arr => {
                    store.publish({type: 'user-images/refresh', payload: arr });
                });
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error(`refreshProfileUserImages()`));
}

// -- about
function refreshProfileAbout() {
    let url = new URL(`${window.location.href}/about`);
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => {
                    store.publish({type: 'about/refresh', payload: obj });
                });
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error(`refreshProfileAbout()`));
}

// -- credentials
function refreshProfileCredential() {
    let url = new URL(`${window.location.href}/credential`);
    return fetch(url)
    .then(res => {
        switch (res.status) {
            case 200 :
                res.json().then(obj => {
                    store.publish({type: 'credential/refresh', payload: obj });
                });
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error(`refreshProfileCredential()`));
}//fetchAndStoreModalImages



// --PUT
// -------------------------------------------------------------------------------------------------


        // --profile-image
        function updateProfileImage(form) {
            let formData = new FormData(form)
            let url = new URL(`${window.location.href}/image`);
            return fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(res => {
                switch (res.status) {
                    case 200 :
                        console.log('profile image updated');
                        break;
                    default:
                        throw res;
                        break;
                }//switch
            }).catch(res => console.error('updateProfileImage()'));
        }

        // -- name
        function updateProfileName(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/name`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile name updated');
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`updateProfileName()`))
        }
        // -- career-status
        // field
        function updateProfileField(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/field`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile field updated');
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`upddateProfileField`))
        }
        // position
        function updateProfilePosition(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/position`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile position updated');
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`updateProfilePosition()`))
        }
        // -- location
        function updateProfileLocation(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/location`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile location updated');
                        break;
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`updateProfileLocation()`))
        }
        // -- about
        function updateProfileAbout(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/about`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile about updated');
                        break;
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`updateProfileAbout()`))
        }
        // -- credential
        function updateProfileCredential(form) {
            let data = new FormData(form);
            let url = new URL(`${window.location.href}/credential`);
            return fetch(url, {
                method: 'POST', 
                body: data,
            }).then(res => {
                switch (res.status) {
                    case 204 :
                        console.log('profile about updated');
                        break;
                    default:
                        throw res;
                        break;
                }
            }).catch(res => console.error(`updateProfileCredential()`))
        }


// --POST
// -------------------------------------------------------------------------------------------------

function storeProfileFileImage(form) {
    let formData = new FormData(form)
    let url = new URL(`${window.location.href}/file-image`);
    return fetch(url, {
        method: 'POST',
        body: formData,
    })
    .then(res => {
        switch (res.status) {
            case 201 :
                console.log('image-stored')
                break;
            default:
                throw res;
                break;
        }
    }).catch(res => console.error('storeProfileUserImage()'));
}

function storeProfileCameraImage(form) {
    let formData = new FormData(form);
    let url = new URL(`${window.location.href}/camera-image`);
    return fetch(url, {
        method: 'POST', 
        body: formData,
    }).then(res => {
        switch (res.status) {
            case 201 :
                console.log('camera image saved');
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error('storeProfileCameraImage()'))
}

// -- credential
function storeProfileCredential(form) {
    let formData = new FormData(form);
    let url = new URL(`${window.location.href}/credential`);
    return fetch(url, {
        method: 'POST', 
        body: formData,
    }).then(res => {
        switch (res.status) {
            case 201 :
                console.log('credential created');
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error('storeProfileCredential()'));
}



// -- DELETE
// -------------------------------------------------------------------------------------------------


// -- credential
function destroyProfileCredential(form) {
    let formData = new FormData(form);
    let url = new URL(`${window.location.href}/credential`);
    return fetch(url, {
        method: 'POST', 
        body: formData,
    }).then(res => {
        switch (res.status) {
            case 204 :
                console.log('credential deleted');
                break;
            default:
                throw res;
                break;
        }//switch
    }).catch(res => console.error('destroyProfileCredential()'));
}



</script>