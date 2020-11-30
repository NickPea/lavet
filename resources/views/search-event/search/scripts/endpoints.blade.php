{{--  --}}



<script>



// --GET & REFRESH STORE
// -------------------------------------------------------------------------------------------------

// // -- profile image
// function refreshSearchListing() {

//     let url = new URL(`${window.location.origin}/search-listing`);
//     url.searchParams.append('what', '')
//     url.searchParams.append('where', '')

//     return fetch(url)
//     .then(res => {
//         switch (res.status) {
//             case 200 :
//                 res.json().then(obj => store.publish({type: 'search-listing/refresh', payload: obj }))
//                 break;
//             default:
//                 throw res
//                 break;
//         }
//     }).catch(res => console.error(`refreshSearchListing()`));
// }


// --PUT
// -------------------------------------------------------------------------------------------------


    // // --profile-image
    // function updateProfileImage(form) {
    //     let formData = new FormData(form)
    //     let url = new URL(`${window.location.href}/image`);
    //     return fetch(url, {
    //         method: 'POST',
    //         body: formData,
    //     })
    //     .then(res => {
    //         switch (res.status) {
    //             case 200 :
    //                 console.log('profile image updated');
    //                 break;
    //             default:
    //                 throw res;
    //                 break;
    //         }//switch
    //     }).catch(res => console.error('updateProfileImage()'));
    // }


// --POST
// -------------------------------------------------------------------------------------------------


// function storeProfileFileImage(form) {
//     let formData = new FormData(form)
//     let url = new URL(`${window.location.href}/file-image`);
//     return fetch(url, {
//         method: 'POST',
//         body: formData,
//     })
//     .then(res => {
//         switch (res.status) {
//             case 201 :
//                 console.log('image-stored')
//                 break;
//             default:
//                 throw res;
//                 break;
//         }
//     }).catch(res => console.error('storeProfileUserImage()'));
// }



// -- DELETE
// -------------------------------------------------------------------------------------------------


// // -- credential
// function destroyProfileCredential(form) {
//     let formData = new FormData(form);
//     let url = new URL(`${window.location.href}/credential`);
//     return fetch(url, {
//         method: 'POST', 
//         body: formData,
//     }).then(res => {
//         switch (res.status) {
//             case 204 :
//                 console.log('credential deleted');
//                 break;
//             default:
//                 throw res;
//                 break;
//         }//switch
//     }).catch(res => console.error('destroyProfileCredential()'));
// }




</script>