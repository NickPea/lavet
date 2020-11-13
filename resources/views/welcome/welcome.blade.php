{{-- spacer
    
    
    
--}}
@extends('layouts.app')

@section('title')
Welcome
@endsection

@section('head')
<style>
    .hover:hover {
        background-color: rgba(211, 211, 211, 0.1);
        box-shadow: 0 0 20px 5px rgba(211, 211, 211, 0.5);
        transform: translateY(-2px);
        transition: 50ms ease-in;
    }

    .search-focus:focus-within {
        background-color: rgba(211, 211, 211, 0.1);
        box-shadow: 0 0 20px 5px rgba(211, 211, 211, 0.5);
        transform: translateY(-2px);
        transition: 50ms ease-in;
    }
</style>
@endsection

@section('main')

<!-- header -->
<div class="container">
    <div class="row" style="height:60vh;">

        <div class="col-6 offset-1 d-flex flex-column justify-content-center">
            <div>
                <h4 class="display-3 font-weight-bold" style="color:rgb(228, 115, 102);">La`Vet</h4>
                <h3 class="text-muted font-weight-bold">Build <u>`your</u> Veterinary Network</h3>
                <h5 class="text-muted text-center">...the easy way.</h5>
            </div>
        </div>

        <div class="col-4 d-flex flex-column justify-content-center">

            @include('welcome.login-card')

        </div> <!-- //col -->
    </div><!-- //row -->
</div> <!-- //header -->



<!-- searchbar -->
<div class="container my-4">
    <div class="row">
        <div class="col">

            <form id="js-search-bar-form">

                <div class="card hover search-focus shadow-lg">
                    <div class="card-body">

                        <!-- row1 -->
                        <div class="form-row mt-2">
                            <div class="position-relative form-group m-0 col-7">
                                <label class="sr-only" for="what">what</label>
                                <!-- input -->
                                <input class="form-control form-control-lg pl-5" type="text" name="what" id="what"
                                    placeholder="search..." autofocus autocomplete="off">
                                <span class="position-absolute"
                                    style="top:25%; left:1.5rem;">@include('components.svg-search')</span>
                            </div>
                            <div class="position-relative form-group m-0 col">
                                <label class="sr-only" for="where">where</label>
                                <!-- input -->
                                <input class="form-control form-control-lg pl-5" type="text" name="where" id="where"
                                    placeholder="location..." autocomplete="off">
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
                                    <input class="form-check-input" type="checkbox" id="profile_check"
                                        name="profile_check" value="true" checked>
                                    <label class="form-check-label" for="profile_check">Profiles</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <!-- input -->
                                    <input class="form-check-input" type="checkbox" id="listing_check"
                                        name="listing_check" value="true" checked>
                                    <label class="form-check-label" for="listing_check">Jobs</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <!-- input -->
                                    <input class="form-check-input" type="checkbox" id="event_check" name="event_check"
                                        value="true" checked>
                                    <label class="form-check-label" for="event_check">Events</label>
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

        </div>
    </div>
</div><!-- //searchbar -->



<!-- search results partial -->
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div id="js-search-results-partial"></div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    searchBarForm = document.querySelector('#js-search-bar-form');

    function fetchSearchResultsPartial(event) {
        event.preventDefault()
        let formData = new FormData(searchBarForm);
        let url = new URL("{{url('/search')}}")
            for (const key_value of formData) {
                url.searchParams.append(key_value[0], key_value[1]);
            }
        fetch(url)
        .then(data => data.text())
        .then(data => document.querySelector('#js-search-results-partial').innerHTML = data)
        .catch(error => console.error(error));
    };

    window.addEventListener('load', (e) => fetchSearchResultsPartial(e));
    // window.addEventListener('pageshow', (e) => searchBarForm.reset()); 
    //reset search bar on back button if not using input[autocomplete]='off'
    searchBarForm.addEventListener('submit', (e) => fetchSearchResultsPartial(e));
    // searchBarForm.addEventListener('keyup', (e) => fetchSearchResultsPartial(e));
    // searchBarForm.addEventListener('change', (e) => fetchSearchResultsPartial(e));
    searchBarForm.addEventListener('input', (e) => fetchSearchResultsPartial(e));
</script>
@endpush



@endsection