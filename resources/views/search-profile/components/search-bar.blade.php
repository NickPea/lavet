{{--  --}}


<style>
    /* ----------------- quick links ----------------- */
    .search-bar-category {
        padding: 0.7rem 3rem;
        margin-right: 0.2rem;
        text-decoration: none !important;
        cursor: pointer !important;
        color: black;
    }

    .search-bar-category:hover {
        color: black;
        background-color: lightgrey;
    }

    .search-bar-category-active {
        color: black;
        background-color: lightgrey;
    }

    /* ----------------//quicklinks -----------------*/


    .search-bar-wrapper {
        background-color: lightgrey;
        color: white;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .search-bar-search-indicator {
        position: absolute;
        top: 0.3rem;
        right: 10%;
    }

    .search-bar-button-disabled {
        cursor: no-drop;
    }

    .search-bar-logo {
        visibility: hidden;
        opacity: 0;
        transition: 50ms;
    }
</style>


<!-- ------------------------------------------------------------------------------------------ -->

<!-- squeezers -->
<div class="row">
    <div class="col-6 offset-3">

        <!-- quick links -->
        <div class="d-flex">
            <a href="{{url('search/event')}}" class="search-bar-category">
                <h5 class="m-0 p-0">Events</h5>
            </a>
            <a href="{{url('search/listing')}}" class="search-bar-category">
                <h5 class="m-0 p-0">Jobs</h5>
            </a>
            <a href="{{url('search/profile')}}" class="search-bar-category search-bar-category-active">
                <h5 class="m-0 p-0">People</h5>
            </a>
        </div>

    </div><!-- //squeezer col -->
</div><!-- //squeezer row -->

<!-- ------------------------------------------------------------------------------------------- -->

<div class="search-bar-wrapper">

    <!-- squeezers -->
    <div class="row">
        <div class="col-10 offset-1">


            <form data-js="search-event-search-bar-form">
                @csrf

                <!-- row -->
                <div class="form-row py-3">

                    <!-- logo -->
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <div data-js="search-event-search-bar-logo" class="search-bar-logo">
                            <div class="d-flex justify-content-center">
                                @include('svg.paw')
                            </div>
                            <div>People</div>
                        </div>
                    </div>

                    <!-- what -->
                    <div class="position-relative form-group m-0 col-6">
                        <label class="sr-only" for="what">what</label>
                        <input name="what" id="what" value="{{old('what')}}"
                            placeholder="looking for something specific?" class="form-control form-control-lg pl-5">
                        <!-- icon -->
                        <span class="position-absolute" style="top:0.7rem; left:1.5rem;">
                            @include('svg.search')
                        </span>
                    </div>

                    <!-- where -->
                    <div class="position-relative form-group m-0 col">
                        <label class="sr-only" for="where">where</label>
                        <input name="where" id="where" value="{{old('where')}}" placeholder="where..."
                            class="form-control form-control-lg pl-5">
                        <!-- icon -->
                        <span class="position-absolute" style="top:0.7rem; left:1.5rem;">
                            @include('svg.searchlocation')
                        </span>
                    </div>


                    <!-- search-button -->
                    <div class="col-2">
                        <button data-js="search-event-search-bar-search-button"
                            class="btn btn-lg btn-outline-secondary btn-block d-flex justify-content-center">
                            <!-- search-indicator -->
                            <div data-js="search-event-search-bar-search-indicator" class="search-bar-search-indicator">
                            </div>
                            <!-- button title -->
                            <div>search</div>
                            <!-- early result count -->
                            <span data-js="search-event-search-bar-search-result-count"></span>
                        </button>
                    </div>
                </div>

            </form>

        </div><!-- //squeezer col -->
    </div><!-- //squeezer row -->

    <!-- scroll indicator  -->
    @include('search-event.components.scroll-indicator')

</div>

<!-- ------------------------------------------------------------------------------------------ -->



<!-- ------------------------------------------------------------------------------------------ -->


<script>
    function EventSearchBar() {


        //DOM
        let searchBarLogo = document.querySelector('[data-js="search-event-search-bar-logo"]');
        let searchBarForm = document.querySelector('[data-js="search-event-search-bar-form"]');
        let searchButton = document.querySelector('[data-js="search-event-search-bar-search-button"]');
        let searchIndicator = document.querySelector('[data-js="search-event-search-bar-search-indicator"]');
        let searchResultCount = document.querySelector('[data-js="search-event-search-bar-search-result-count"]');

        !searchBarLogo && console.error('dom query not found');
        !searchBarForm && console.error('dom query not found');
        !searchButton && console.error('dom query not found');
        !searchIndicator && console.error('dom query not found');
        !searchResultCount && console.error('dom query not found');

        //EVENTS

        //show search bar logo on scroll
        window.addEventListener('scroll', function (e) {
            if (window.scrollY > 150) {
                searchBarLogo.style.visibility = 'visible';
                searchBarLogo.style.opacity = '1';

            } else {
                searchBarLogo.style.visibility = 'hidden';
                searchBarLogo.style.opacity = '0';
            }
        });

        
        // -- select and focus 'what' input control on load/refresh of window
        window.addEventListener('load', function (e) {
            searchBarForm.elements['what'].select();
        });


        // -- select and focus 'what' input control on scroll to top of window
        window.addEventListener('scroll', function (e) {
            if (window.scrollY == 0) {
                searchBarForm.elements['what'].select();

            }
        });

        // -- get feedback of expected search result success on input change
        searchBarForm.addEventListener('input', async () => {

            // ..load
            searchIndicator.innerHTML = '<div class="spinner-grow spinner-grow-sm"></div>'

            // fetch and await count
            let count = await getEarlyResultCount(searchBarForm);

            // finish loading, show count and button visually react to count
            searchIndicator.innerHTML = null;
            searchResultCount.innerHTML = `<small>&nbsp;(${count.trim()})</small>`;

            if (count > 0) {
                //enable
                searchButton.classList.add('btn-success');
                searchButton.classList.remove('btn-outline-secondary');
            } else {
                //disabled
                searchButton.classList.add('btn-outline-secondary');
                searchButton.classList.remove('btn-success');
            }

         

           

        });






    }
    EventSearchBar();



</script>