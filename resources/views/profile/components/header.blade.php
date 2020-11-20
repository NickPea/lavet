<style>
    .image-hover:hover {
        filter: brightness(90%);
    }

    .image-edit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: lightgrey;
        padding: 0.3rem;
        cursor: pointer;
    }
    .image-edit-button:hover {
        background: rgb(231, 230, 230);
        box-shadow: 0 0 2px 1px rgb(136, 136, 136)

    }
    .image-edit-button:active {
        transform: scale(0.9);

    }
</style>

<div class="row pb-1">
    <div class="col">

        <div class="d-flex justify-content-end">
            <!-- btn group -->
            <div class="btn-group">
                <a class="options-button" data-js="header-edit-button">
                    @include('svg.edit')
                </a>
            </div>
        </div>

    </div>
</div>

<!-- card -->
<div class="card p-2 rounded-lg shadow-lg">
    <!-- card-body -->
    <div class="card-body">

        <!-- row -->
        <div class="row">

            <!-- col1 -->
            <div class="col-5">

                <!-- overlay-wrapper -->
                <div class="position-relative">
                    <!-- image -->
                    <a href={{asset($profile->image->first()->path)}}>
                        <img class="w-100 rounded image-hover" src={{asset($profile->image->first()->path)}}
                            alt="profile image">
                    </a>
                    <!-- overlay -->
                    <div class="position-absolute" style="top:-5%; left:-5%">
                        <!-- online badge -->
                        <h5>
                            @if ($profile->is_free===1)
                            <span class="badge badge-success border py-2">
                                Online
                            </span>
                            @else
                            <span class="badge badge-secondary border py-2">
                                Offline
                            </span>
                            @endif
                        </h5>
                    </div>
                    <!-- edit image -->
                    <div class="position-absolute" style="bottom:-0.5rem; right:-0.5rem">
                        <h5 class="m-0">
                            <span class="image-edit-button">
                                @include('svg.edit')
                            </span>
                        </h5>
                    </div>
                </div><!-- //overlay-wrapper -->


            </div><!-- //col1 -->

            <!-- col2 -->
            <div class="col">

                {{-- Details --}}
                <div data-js="header-details">

                    <div class="h-100 d-flex flex-column justify-content-ed">

                        <!-- Name -->
                        <h3 class="font-weight-bold">
                            <span data-js="header-name"></span>
                        </h3>
                        <!-- Field -->
                        <h6 class="text-muted font-weight-lighter">
                            <span data-js="header-field"></span>
                        </h6>
                        <!-- Position -->
                        <h5 class="text-secondary">
                            <span data-js="header-position"></span>
                        </h5>

                    </div><!-- //flex -->

                </div>
                {{-- //Details --}}


                {{-- Hidden-Form --}}
                <div data-js="header-hidden" style="display: none">

                    <form data-js="header-form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="field" class="sr-only">Name</label>
                            <input type="text" name="field" id="field" placeholder="Field"
                                class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="position" class="sr-only">Name</label>
                            <input type="text" name="position" id="position" placeholder="Position"
                                class="form-control form-control-lg">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button data-js="header-form-cancel-button" tabindex="-1"
                                class="btn btn-outline-secondary btn-lg">cancel</button>
                            <button data-js="header-form-submit-button" type="submit"
                                class="btn btn-primary btn-lg ml-2">save</button>
                        </div>

                    </form>

                </div>
                {{-- //Hidden-Form --}}


            </div>
            <!--//col2 -->


        </div>
        <!--// row -->

    </div> <!-- //card-body -->
</div> <!-- //card -->


<script>
    function Header() {

        // dom
        let headerEditButton = document.querySelector('[data-js="header-edit-button"]');
        let headerDetails = document.querySelector('[data-js="header-details"]');
        let headerHidden = document.querySelector('[data-js="header-hidden"]');
        let headerForm = document.querySelector('[data-js="header-form"]');
        let headerFormCancelButton = document.querySelector('[data-js="header-form-cancel-button"]');
        let headerName = document.querySelector('[data-js="header-name"]');
        let headerField = document.querySelector('[data-js="header-field"]');
        let headerPosition = document.querySelector('[data-js="header-position"]');

        // dom-check
        !headerEditButton && console.error('edit button not found');
        !headerDetails && console.error('details not found');
        !headerHidden && console.error('hidden not found');
        !headerForm && console.error('form not found');
        !headerFormCancelButton && console.error('form cancel button not found');
        !headerName && console.error('name not found');
        !headerField && console.error('field  not found');
        !headerPosition && console.error('position not found');

        //events
        headerEditButton.addEventListener('click', () => {
            store.publish({type: 'header/toggle-form'});
            if (store.getState().showHeaderForm === true) {
                headerEditButton.classList.add('options-button-selected')
                headerDetails.style.display = 'none';
                headerHidden.style.display = 'block';
                headerForm.elements['name'].value = headerName.innerHTML;
                headerForm.elements['field'].value = headerField.innerHTML;
                headerForm.elements['position'].value = headerPosition.innerHTML;
            } else {
                headerEditButton.classList.remove('options-button-selected')
                headerDetails.style.display = 'block';
                headerHidden.style.display = 'none';
            }
        });
        
        headerFormCancelButton.addEventListener('click', () => {
                event.preventDefault();
                store.publish({type: 'header/toggle-form'});
                headerEditButton.classList.remove('options-button-selected')
                headerDetails.style.display = 'block';
                headerHidden.style.display = 'none';
        });

       
        headerForm.addEventListener('submit', () => {
            event.preventDefault();
            let formData =  new FormData(headerForm);
            let url = new URL(`${window.location.href}/header`)
            fetch(url, {
                method: "POST",
                body: formData,
            })
            .then(res => {
                switch (res.status) {
                    case 204 :
                        fetchAndStore();
                        headerEditButton.classList.remove('options-button-selected')
                        headerDetails.style.display = 'block';
                        headerHidden.style.display = 'none';
                        break;
                    default:
                        console.error(`header error: failed to update. Status: ${res.status}`)
                        break;
                }//switch
            })//then
        })//submit


        //event handlers


        //fetch and store data
        function fetchAndStore () {
            let url = new URL(`${window.location.href}?section=header`);
            fetch(url)
            .then(res => res.json())
            .then(obj => store.publish({type:'header/update-data', payload: obj}))
        }
        fetchAndStore();


        //subscribe render
        function renderHeader(oldState, newState) {
            if(!_.isEqual(oldState.header, newState.header)) {
                console.log('header rendering')
                headerName.innerHTML = newState.header.name;
                headerField.innerHTML = newState.header.field;
                headerPosition.innerHTML = newState.header.position;
            }
        }//render
        store.subscribe(renderHeader);


    }//Header()
    Header();

</script>