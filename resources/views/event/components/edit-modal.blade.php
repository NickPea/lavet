{{--  --}}


<style>
    /* modal styles */

    .event-edit-modal-wrapper {
        display: none;
        /* toggle */
    }

    .event-edit-modal-backdrop {

        z-index: 99999999999999999999999999999999999999999999;

        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;

        background-color: rgba(0, 0, 0, 0.5);

        overflow-y: auto;
    }

    .event-edit-modal-content {

        height: auto;
        width: 700px;

        background-color: white;
        border-radius: 5px;

        margin: 10vh auto;
        padding: 40px;

        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;

    }

    /* each item styles */

    .event-edit-modal-item-title {
        color: rgb(80, 80, 80);
        font-size: 1.2rem;
        font-weight: bolder;
        border-bottom: 2px solid lightgrey;
    }

    .event-edit-modal-item-entry {

        width: 90%;
        margin: 20px auto;

        background-color: lightgrey;
        border-radius: 10px;

        padding: 1rem;

        cursor: pointer;
    }

    .event-edit-modal-item-entry:hover {
        background-color: rgb(230, 230, 230)
    }

    .event-edit-modal-image-item {
        min-width: 100%;
        max-width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .event-edit-modal-item-form {
        display: none;

        width: 90%;
        margin: 20px auto;
    }

    .event-edit-modal-image-input-hidden {
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
    }

    .event-edit-modal-image-input-label-wrapper {
        width: 100%;
        margin-bottom: 0;
        display: block;
    }
</style>



{{-- ------------------------------------------------------------------------------------------ --}}



<div data-js="event-edit-modal-wrapper" class="event-edit-modal-wrapper">

    <div data-js="event-edit-modal-backdrop" class="event-edit-modal-backdrop">

        <div class="event-edit-modal-content">

            {{-- // -- version-two-feature --

            <!-- HOSTED BY -->
            <span class="event-edit-modal-item-title">Hosted by</span>
            <div data-js="event-edit-modal-hosted-by-entry" class="event-edit-modal-item-entry"></div> 

            --}}

            <!-- TITLE -->
            <span class="event-edit-modal-item-title">Title</span>
            <div data-js="event-edit-modal-title-entry" class="event-edit-modal-item-entry"></div>
            <form data-js="event-edit-modal-title-form" class="event-edit-modal-item-form">
                <input name="event_title" class="form-control form-control-lg">
                <div class="d-flex mt-3">
                    <button data-js="event-edit-modal-title-form-cancel" class="btn btn-outline-secondary ml-auto"
                        tabindex="-1">cancel</button>
                    <button class="btn btn-primary ml-1">save</button>
                </div>
            </form>

            <!-- IMAGE -->
            <span class="event-edit-modal-item-title">Image</span>
            <label for="event_image" class="event-edit-modal-image-input-label-wrapper">
                <div data-js="event-edit-modal-image-entry" class="event-edit-modal-item-entry"></div>
                <input type="file" name="event_image" id="event_image" accept="image/*"
                    data-js="event-edit-modal-image-input" class="event-edit-modal-image-input-hidden">
            </label>

            <!-- WHEN -->
            <span class="event-edit-modal-item-title">When</span>
            <div class="event-edit-modal-item-entry">
                <div data-js="event-edit-modal-when-date-entry"></div>
                <div data-js="event-edit-modal-when-time-entry"></div>
            </div>
            <form data-js="event-edit-modal-when-form" class="event-edit-modal-item-form">
                <div class="row mb-2 font-weight-bold">
                    <div class="col">&nbsp;From&nbsp;</div>
                    <div class="col">&nbsp;To&nbsp;</div>
                </div>
                <!-- dates -->
                <div class="row">
                    <div class="col">
                        <input type="date" name="event_when_start_date" class="form-control form-control-lg">
                    </div>
                    <div class="col">
                        <input type="date" name="event_when_end_date" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">-</div>
                </div>
                <!-- time -->
                <div class="row">
                    <div class="col">
                        <input type="time" name="event_when_start_time" class="form-control form-control-lg">
                    </div>
                    <div class="col">
                        <input type="time" name="event_when_end_time" class="form-control form-control-lg">
                    </div>
                </div>
            </form>

            <!-- WHERE -->
            <span class="event-edit-modal-item-title">Where</span>
            <div data-js="event-edit-modal-where-entry" class="event-edit-modal-item-entry"></div>

            <form data-js="event-edit-modal-where-form" class="event-edit-modal-item-form">

                <label for="event_where_township">Township</label>
                <input name="event_where_township" id="event_where_township" class="form-control form-control-lg mb-1">

                <label for="event_where_city">City</label>
                <input name="event_where_city" id="event_where_city" class="form-control form-control-lg mb-1">

                <label for="event_where_province">Province</label>
                <input name="event_where_province" id="event_where_province" class="form-control form-control-lg mb-1">

                <label for="event_where_country">Country</label>
                <input name="event_where_country" id="event_where_country" class="form-control form-control-lg mb-1">

                <label for="event_where_area_code">Area Code</label>
                <input name="event_where_area_code" id="event_where_area_code"
                    class="form-control form-control-lg mb-1">

                <div class="d-flex mt-3">
                    <button class="btn btn-outline-secondary ml-auto">cancel</button>
                    <button class="btn btn-primary ml-1">save</button>
                </div>
            </form>

            <!-- ABOUT -->
            <span class="event-edit-modal-item-title">About</span>
            <div data-js="event-edit-modal-about-entry" class="event-edit-modal-item-entry"></div>
            <form data-js="event-edit-modal-about-form" class="event-edit-modal-item-form">
                <textarea name="event_about" class="form-control form-control-lg" rows="8"></textarea>
                <div class="d-flex mt-3">
                    <button data-js="event-edit-modal-about-form-cancel" class="btn btn-outline-secondary ml-auto" tabindex="-1">cancel</button>
                    <button class="btn btn-primary ml-1">save</button>
                </div>
            </form>

        </div><!-- //content -->
    </div><!-- //backdrop -->
</div><!-- //wrapper -->



{{-- ------------------------------------------------------------------------------------------ --}}



<script>
    function EventEditModal() {


        //LOCAL STATE

            let titleFormOpen, aboutFormOpen = false;

        //DOM

            const editModalWrapper = document.querySelector('[data-js="event-edit-modal-wrapper"]');
            const editModalBackdrop = editModalWrapper.querySelector('[data-js="event-edit-modal-backdrop"]');
                //--entries
            // const hostedByEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-hosted-by-entry"]');
            // const tagEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-tag-entry"]');
            const titleEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-title-entry"]');
            const imageEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-image-entry"]');
            const whatEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-what-entry"]');
            const whenDateEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-when-date-entry"]');
            const whenTimeEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-when-time-entry"]');
            const whereEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-where-entry"]');
            const aboutEntry = editModalWrapper.querySelector('[data-js="event-edit-modal-about-entry"]');
                //--forms
            const imageInput = editModalWrapper.querySelector('[data-js="event-edit-modal-image-input"]');
            const titleForm = editModalWrapper.querySelector('[data-js="event-edit-modal-title-form"]');
            const titleFormCancel = titleForm.querySelector('[data-js="event-edit-modal-title-form-cancel"]');
            const aboutForm = editModalWrapper.querySelector('[data-js="event-edit-modal-about-form"]');
            const aboutFormCancel = aboutForm.querySelector('[data-js="event-edit-modal-about-form-cancel"]');

        //EVENTS

            //close edit modal on click away (backdrop click)
            editModalWrapper.addEventListener('click', (e) => {

                if (e.target === editModalBackdrop) {
                    store.publish({
                        type: 'event-edit-modal/hide'
                    });
                }//if
            });


            //upload image after select
            imageInput.addEventListener('change', async (e) => {

                //show selected image and 'saving' indicator 
                const imgUrl = URL.createObjectURL(e.target.files[0]);
                imageEntry.innerHTML = `
                        <div style="position:relative; min-width: 100%;">
                            <img src="${imgUrl}" style="max-width:10%; min-width:10%;"/>
                            <span style="position:absolute; top:calc(50% - 10px); right:5%;">Saving...</span>
                        </div>
                    `;

                //post new image and refresh state
                const fetchData = await postEventImage(e.target.files[0]);
                
                if (fetchData == 403) {
                    alert('Please sign in first');

                }

                //update state
                store.publish({
                    type: 'event-image/refresh',
                    payload: fetchData.image
                });

            });//uploadimage


            //show title form
            titleEntry.addEventListener('click', () => {
                titleFormOpen = true;
                renderTitleForm();
                titleForm.elements['event_title'].value = store.getState().event_title;
                titleForm.elements['event_title'].select();
            });//

            //hide title form
            titleFormCancel.addEventListener('click', (e) => {
                e.preventDefault();
                titleFormOpen = false;
                renderTitleForm();                     
            });//

            //update title on save button click
            titleForm.addEventListener('submit', (e) => {
                updateTitleEventListener(e);
            });//

            //update title on enter key
            titleForm.elements['event_title'].addEventListener('keydown', (e) => {
                if (e.key == 'Enter') {
                    // updateTitleEventListener(e);
                    e.preventDefault();
                }
            });//

            //update title helper
            const updateTitleEventListener = async (e) => {
                e.preventDefault();
                //get value
                let newEventTitle = titleForm.elements['event_title'].value;
                //close form
                titleFormOpen = false;
                renderTitleForm();
                //show saving indicator
                titleEntry.innerHTML = `<div>Saving...</div>`;
                //post data
                const fetchData = await postEventTitle(newEventTitle);
                //refresh state with returned
                store.publish({
                    type: 'event-title/refresh', 
                    payload: fetchData.title,
                });
            }//

            //show about form
            aboutEntry.addEventListener('click', (e) => {
                aboutFormOpen = true;
                renderAboutForm();
                aboutForm.elements['event_about'].value = store.getState().event_about;
                aboutForm.elements['event_about'].select();
            });

            //hide about form
            aboutFormCancel.addEventListener('click', (e) => {
                e.preventDefault();
                aboutFormOpen = false;
                renderAboutForm();
            });

            //update about on save button click
            aboutForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                //get data
                const newEventAbout = aboutForm.elements['event_about'].value;
                //show saving indicator
                aboutEntry.innerHTML = `<div>Saving...</div>`;
                //post data
                const fetchData = await postEventAbout(newEventAbout);
                //auth
                if (fetchData == 403) {alert('Please sign in first')}
                //toggle form
                aboutFormOpen = false;
                renderAboutForm();
                //refresh state
                store.publish({
                    type: 'event-about/refresh', 
                    payload: fetchData.about,
                })
            });//


        //RENDER
            
            //render EDIT MODAL
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_edit_modal_show, newState.event_edit_modal_show)) {

                    if (newState.event_edit_modal_show) {
                        editModalWrapper.style.display = 'block';
                    } else {
                        editModalWrapper.style.display = 'none';
                    }

                }//ifstatechange
            });

            //render TITLE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_title, newState.event_title)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_title));

                    titleEntry.innerHTML = `
                        <div>
                            ${selectState}
                        </div>
                    `;

                }//ifstatechange
            });

            //render IMAGE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_image, newState.event_image)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_image));

                    imageEntry.innerHTML = `
                        <img src="${selectState}" class="event-edit-modal-image-item"/>
                    `;

                }//ifstatechange
            });

            //render WHAT
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_what, newState.event_what)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_what));

                    whenEntry.innerHTML = `
                        <div>${selectState}</div>
                    `;

                }//ifstatechange
            });

            //render WHEN - dates
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_when, newState.event_when)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_when));

                    whenDateEntry.innerHTML = `
                        <div> <b>Date:</b> ${selectState.start} - ${selectState.end}</div>
                    `;

                }//ifstatechange
            });

            //render WHEN - time
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_time, newState.event_time)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_time));

                    whenTimeEntry.innerHTML = `
                        <div> <b>Time:</b> ${selectState.start} - ${selectState.end}</div>
                    `;

                }//ifstatechange
            });

            //render WHERE
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_location, newState.event_location)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_location));

                    whereEntry.innerHTML = `
                        <div><b>Town - </b> ${selectState.township}</div>
                        <div><b>City - </b> ${selectState.city}</div>
                        <div><b>Province - </b> ${selectState.province}</div>
                        <div><b>Country - </b> ${selectState.country}</div>
                        <div><b>Area-Code - </b> ${selectState.area_code}</div>
                    `;

                }//ifstatechange
            });
            
            //render ABOUT
            store.subscribe((oldState, newState) => {
                if (!_.isEqual(oldState.event_about, newState.event_about)) {

                    const selectState = JSON.parse(JSON.stringify(newState.event_about));

                    aboutEntry.innerHTML = `
                        <div>${selectState}</div>
                    `;

                }//ifstatechange
            });



            // -- version-two-features ---------------------------------------------------------


            // //render HOSTEDBY
            // store.subscribe((oldState, newState) => {
            //     if (!_.isEqual(oldState.event_hosted_by, newState.event_hosted_by)) {

            //         const selectState = JSON.parse(JSON.stringify(newState.event_hosted_by));

            //         hostedByEntry.innerHTML = `
            //             <div>Name: ${selectState.name}</div> 
            //             <div>Image: ${selectState.image}</div> 
            //             <div>Link: ${selectState.link}</div> 
            //         `;

            //     }//ifstatechange
            // });


            //render TAG
            // store.subscribe((oldState, newState) => {
            //     if (!_.isEqual(oldState.event_tag, newState.event_tag)) {

            //         const selectState = JSON.parse(JSON.stringify(newState.event_tag));

            //         tagEntry.innerHTML = selectState.map((tag) => {
            //             return `
            //                 ${tag}
            //             `;
            //         }).join('<br>');

            //     }//ifstatechange
            // });



            //render TITLE FORM
            function renderTitleForm() {
                if (titleFormOpen) {
                    titleEntry.style.display = "none";
                    titleForm.style.display = "block"
                } else {
                    titleEntry.style.display = "block";
                    titleForm.style.display = "none"
                }//if
            }//


            //render ABOUT FORM
            function renderAboutForm() {
                if (aboutFormOpen) {
                    aboutEntry.style.display = "none";
                    aboutForm.style.display = "block"
                } else {
                    aboutEntry.style.display = "block";
                    aboutForm.style.display = "none"
                }//if
            }//


            // --------------------------------------------------------------------------------



    }//EventEditModal
    document.addEventListener('DOMContentLoaded', EventEditModal);



</script>