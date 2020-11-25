{{--  --}}



<style>
    .image-hover:hover {
        filter: brightness(90%);
    }

    .edit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: lightgrey;
        padding: 0.3rem;
        cursor: pointer;
    }

    .edit-button:hover {
        background: rgb(231, 230, 230);
        box-shadow: 0 0 2px 1px rgb(136, 136, 136)
    }

    .edit-button:active {
        transform: scale(0.9);

    }
</style>


{{-- ---------------------------------------------------------------------------------------------------- --}}

<!-- card -->
<div class="card p-2 rounded-lg shadow-lg">
    <div class="card-body">

        <!-- row -->
        <div class="row">

            <!-- col1 -->
            <div class="col-5">

                <!-- overlay-wrapper -->
                <div class="position-relative">
                    <!-- image -->
                    <span data-js="header-profile-image">
                        {{-- profile imager render here --}}
                    </span>
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
                    <div data-js="profile-image-edit-button" class="position-absolute"
                        style="top:-0.5rem; right:-0.5rem">
                        <h5 class="m-0">
                            <span class="edit-button">
                                @include('svg.camera')
                            </span>
                        </h5>
                    </div>
                </div><!-- //overlay-wrapper -->


            </div><!-- //col1 -->

            <!-- col2 -->
            <div class="col d-flex flex-column">

                {{-- Details --}}
                <div data-js="header-details">

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
                </div>
                {{-- //Details --}}


                {{-- Location --}}
                <div class="location-wrapper mt-auto">

                    <!-- .flex -->
                    <div class="d-flex align-items-center">

                        <!-- data-display -->
                        <div data-js="location-entry">
                            <h6 class="d-inline">
                                @include('svg.location')
                                <span class="text-muted font-weight-light">
                                    <span data-js="location-city"></span>
                                    <span data-js="location-province"></span>
                                    <span data-js="location-country"></span>
                                    <span data-js="location-area-code"></span>
                                    <span data-js="location-uknonwn"></span>
                                </span>
                            </h6>
                        </div>

                    </div><!-- //.flex -->

                </div><!-- //location-wrapper -->
                {{-- //Location --}}


            </div>
            <!--//col2 -->

            <!-- col3 -->
            <div class="col-1">

                <div class="d-flex justify-content-end">
                    <a data-js="header-edit-button" class="edit-button" >
                        @include('svg.edit')
                    </a>
                </div>

            </div>
            <!-- //col3 -->


        </div>
        <!--// row -->

    </div> <!-- //card-body -->
</div> <!-- //card -->


{{-- ---------------------------------------------------------------------------------------------------- --}}



<script>
    'use strict'
    function Header() {

        // DOM

        let editButton = document.querySelector('[data-js="header-edit-button"]');
        let headerDetails = document.querySelector('[data-js="header-details"]');
        let headerName = document.querySelector('[data-js="header-name"]');
        let headerField = document.querySelector('[data-js="header-field"]');
        let headerPosition = document.querySelector('[data-js="header-position"]');
        let editImageButton = document.querySelector('[data-js="profile-image-edit-button"]');
        let profileImage = document.querySelector('[data-js="header-profile-image"]');
        !editButton && console.error('edit button not found');
        !headerDetails && console.error('details not found');
        !headerName && console.error('name not found');
        !headerField && console.error('field  not found');
        !headerPosition && console.error('position not found');
        !editImageButton && console.error('profile image edit button not found');
        !profileImage && console.error('profile image not found');

        //EVENTS

        editButton.addEventListener('click', () => {
            store.publish({type: 'profile-edit-modal/toggle'});
        });

        editImageButton.addEventListener('click', () => {
            store.publish({type:'profile-image-modal/toggle'})
        })

        //RENDER

        function renderProfileHeader(oldState, newState) {
            if(!_.isEqual(oldState.name, newState.name)) {
                headerName.innerHTML = newState.name;
            }
            if(!_.isEqual(oldState.field, newState.field)) {
                headerField.innerHTML = newState.field;
            }
            if(!_.isEqual(oldState.position, newState.position)) {
                headerPosition.innerHTML = newState.position;
            }
            if(!_.isEqual(oldState.image, newState.image)) {
                profileImage.innerHTML = (`
                    <img class="w-100 rounded image-hover" src="${newState.image.path}" alt="profile image">
                `);
            }
        }
        store.subscribe(renderProfileHeader);

    }//Header()
    Header();

</script>

<script>
    'use strict'
    function Location() {
        
        //DOM
        let city = document.querySelector('[data-js="location-city"]')
        let province = document.querySelector('[data-js="location-province"]')
        let country = document.querySelector('[data-js="location-country"]')
        let areaCode = document.querySelector('[data-js="location-area-code"]')
        let locationUnknown = document.querySelector('[data-js="location-uknonwn"]')
        !city && console.error('no city entry');
        !province && console.error('no province entry');
        !country && console.error('no country entry');
        !areaCode && console.error('no area-code entry');
        !locationUnknown && console.error('no location-unknown entry');

        //RENDER

        function renderProfileLocation (oldState, newState) {
            if (!_.isEqual(oldState.location, newState.location)) {
                if (Object.values(newState.location).every(place => place === null)) {
                    locationUnknown.innerHTML = 'unknown'
                    [city, province, country, areaCode].forEach(dom => {
                        dom.innerHTML = null;
                    });
                } else {
                    locationUnknown.innerHTML = null
                    city.innerHTML = newState.location.city;
                    province.innerHTML = newState.location.province;
                    country.innerHTML = newState.location.country;
                    areaCode.innerHTML = newState.location.area_code;
                }
            }//endif
        }
        store.subscribe(renderProfileLocation)

    }//Location
    Location()

</script>