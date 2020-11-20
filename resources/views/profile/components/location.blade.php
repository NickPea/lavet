{{--  --}}


<style>

</style>


{{-- ------------------------------------------------------------------------------------------ --}}


<div class="location-wrapper">
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
        <!-- btn group -->
        <div class="btn-group ml-auto">
            <a class="options-button" data-js="edit-location-button">
                @include('svg.edit')
            </a>
        </div>
    </div>
    <!-- hidden-form -->
    <div data-js="hidden-section" style="display:none" class="mt-2">
        <div class="card">
            <div class="card-body">
                <form data-js="location-form">
                    @csrf
                    <div class="form-group">
                        <label for="city" class="sr-only">City</label>
                        <input data-js="location-form-city" type="text" name="city" id="city" placeholder="City..."
                            class="form-control form-control-lg form-control-block">
                    </div>
                    <div class="form-group">
                        <label for="province" class="sr-only">Province</label>
                        <input data-js="location-form-province" type="text" name="province" id="province"
                            placeholder="State..." class="form-control form-control-lg form-control-block">
                    </div>
                    <div class="form-group">
                        <label for="country" class="sr-only">Country</label>
                        <input data-js="location-form-country" type="text" name="country" id="country"
                            required placeholder="Country..." class="form-control form-control-lg form-control-block">
                    </div>
                    <div class="form-group">
                        <label for="area_code" class="sr-only">Area Code</label>
                        <input data-js="location-form-area-code" type="text" name="area_code" id="area_code"
                            placeholder="Postcode..." class="form-control form-control-lg form-control-block">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button data-js="location-form-cancel-button" tabindex="-1"
                            class="btn btn-outline-secondary btn-lg">cancel</button>
                        <button type="submit" class="btn btn-primary btn-lg ml-2">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- //hidden-form -->
</div><!-- //location-wrapper -->


{{-- ------------------------------------------------------------------------------------------ --}}


<script>
    'use strict'
    function Location() {
        
        //dom
        let city = document.querySelector('[data-js="location-city"]')
        let province = document.querySelector('[data-js="location-province"]')
        let country = document.querySelector('[data-js="location-country"]')
        let areaCode = document.querySelector('[data-js="location-area-code"]')
        let locationUnknown = document.querySelector('[data-js="location-uknonwn"]')
        
        let formCity = document.querySelector('[data-js="location-form-city"]')
        let formProvince = document.querySelector('[data-js="location-form-province"]')
        let formCountry = document.querySelector('[data-js="location-form-country"]')
        let formAreaCode = document.querySelector('[data-js="location-form-area-code"]')

        let editLocationButton = document.querySelector('[data-js="edit-location-button"]')
        let hiddenSection = document.querySelector('[data-js="hidden-section"]')
        let locationForm = document.querySelector('[data-js="location-form"]')
        let locationFormCancelButton = document.querySelector('[data-js="location-form-cancel-button"]')

        //dom-check
        !city && console.error('no city entry');
        !province && console.error('no province entry');
        !country && console.error('no country entry');
        !areaCode && console.error('no area-code entry');
        !locationUnknown && console.error('no location-unknown entry');
        
        !formCity && console.error('no form city entry');
        !formProvince && console.error('no form province entry');
        !formCountry && console.error('no form country entry');
        !formAreaCode && console.error('no form area-code entry');

        !editLocationButton && console.error('no edit location button');
        !hiddenSection && console.error('no hidden section')
        !locationForm && console.error('no address form');
        !locationFormCancelButton && console.error('no address form');


       //events
       editLocationButton.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'location/toggle-form'});
            if(store.getState().locationFormVisible) {
                hiddenSection.style.display = 'block';
                editLocationButton.classList.add('options-button-selected');
                formCity.value = city.innerHTML;
                formProvince.value = province.innerHTML;
                formCountry.value = country.innerHTML;
                formAreaCode.value = areaCode.innerHTML;
            } else {
                hiddenSection.style.display = 'none';
                editLocationButton.classList.remove('options-button-selected');
            }
        });
        locationFormCancelButton.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'location/toggle-form'});
            if(store.getState().locationFormVisible) {
                hiddenSection.style.display = 'block';
            } else {
                hiddenSection.style.display = 'none';
                editLocationButton.classList.remove('options-button-selected');

            }
        });
        locationForm.addEventListener('submit', () => {
            event.preventDefault();
            let formData = new FormData(locationForm)
            let url = new URL(`${window.location.href}/location`)
            fetch(url , {
                method: 'POST',
                body: formData,
            })
            .then(res => {
                switch (res.status) {
                    case 201:
                        fetchAndStore();
                        hiddenSection.style.display = 'none';
                        editLocationButton.classList.remove('options-button-selected');
                        break;
                    case 422:
                        res.json().then(obj => {
                            console.error(`invalid input: ${Object.keys(obj)}`);
                        });
                        break;
                    default:
                        console.error('failed to update location')
                        break;
                }//switch
            });//then
        })//submit


        //event handlers


        //fetch and update store
        function fetchAndStore () {
            let url = new URL(`${window.location.href}?section=location`);
            fetch(url)
            .then(res => res.json())
            .then(obj => {
                store.publish({type: 'location/update-data', payload: obj})
            });
        }
        fetchAndStore();

        //subcribed render
        function render (oldState, newState) {
            if (!_.isEqual(oldState.location, newState.location)) {
                console.log('location rendering');
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
        } //render
        store.subscribe(render)

    }//Location
    Location()

</script>