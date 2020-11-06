<form action={{secure_url('/search')}} method="get" {{-- target="_blank   " --}}>


    <div class="card hover search-focus shadow-lg">
        <div class="card-body">

            
            <!-- row1 -->
            <div class="form-row mt-2">
                <div class="position-relative form-group m-0 col-7">
                    <label class="sr-only" for="what">what</label>
                    <!-- input -->
                    <input class="form-control form-control-lg pl-5" type="text" name="what" id="what"
                        placeholder="search..." autofocus>
                    <span class="position-absolute"
                        style="top:25%; left:1.5rem;">@include('components.svg-search')</span>
                </div>
                <div class="position-relative form-group m-0 col">
                    <label class="sr-only" for="where">where</label>
                    <!-- input -->
                    <input class="form-control form-control-lg pl-5" type="text" name="where" id="where"
                        placeholder="location...">
                    <span class="position-absolute"
                        style="top:25%; left:1.5rem;">@include('components.svg-searchlocation')</span>
                </div>
            </div>
            <!-- //row1 -->



            <!-- row2 -->
            <div class="row mt-1">
                <div class="col d-flex">
                    <span class="align-self-center mx-2">Include:</span>
                    <div class="form-check form-check-inline">
                        <!-- input -->
                        <input class="form-check-input" type="checkbox" id="search_profiles" name="include_profiles" value="true" checked>
                        <label class="form-check-label" for="search_profiles">Profiles</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <!-- input -->
                        <input class="form-check-input" type="checkbox" id="search_listings" name="include_listings" value="true" checked>
                        <label class="form-check-label" for="search_listings">Jobs</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <!-- input -->
                        <input class="form-check-input" type="checkbox" id="search_events" name="include_events" value="true" checked>
                        <label class="form-check-label" for="search_events">Events</label>
                    </div>
                    <div class="ml-auto">
                        <!-- submit -->
                        <button class="btn btn-outline-primary btn-lg px-5" type="submit">
                            <small>search</small>
                        </button>
                    </div>
                </div>
            </div>
            <!-- //row2 -->




        </div> <!-- //card-body -->
    </div><!-- //card -->

</form>