{{--  --}}


<style>
    .search-focus:focus-within {
        background-color: rgba(211, 211, 211, 0.1);
        box-shadow: 0 0 20px 5px rgba(211, 211, 211, 0.5);
        transform: translateY(-2px);
        transition: 50ms ease-in;
    }

    .search-bar-button {
        border: 1px solid grey;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 0.7rem 2rem;
        margin-right: 0.2rem;
        text-decoration: none !important;
        cursor: pointer !important;
        color: black;
    }

    .search-bar-button:hover {
        color: white;
        background-color: grey;
    }

    .search-bar-button-active {
        color: white;
        background-color: grey;
    }
</style>


<!-- ------------------------------------------------------------------------------------------ -->

<!-- searchbar -->

<div class="search-bar-wrapper">

    <h5 class="py-2 font-weight-bold ">Search veterinary events</h5>
    
    
    <div class="d-flex">
        <a href="{{url('search/event')}}" class="search-bar-button search-bar-button-active">
            <h5 class="m-0 p-0">Events</h5>
        </a>
        <a href="{{url('search/listing')}}" class="search-bar-button">
            <h5 class="m-0 p-0">Jobs</h5>
        </a>
        <a href="{{url('search/profile')}}" class="search-bar-button">
            <h5 class="m-0 p-0">People</h5>
        </a>
    </div>
    
    <div class="card search-focus shadow-lg">
        <div class="card-body">
    
    
            <form>
    
                <!-- row -->
                <div class="form-row mb-2">
    
                    <!-- what -->
                    <div class="position-relative form-group m-0 col-6">
                        <label class="sr-only" for="what">what</label>
                        <input name="what" id="what" placeholder="search..." autofocus
                            class="form-control form-control-lg pl-5">
                        <span class="position-absolute" style="top:0.7rem; left:1.5rem;">
                            @include('svg.search')
                        </span>
                    </div>
    
                    <!-- where -->
                    <div class="position-relative form-group m-0 col">
                        <label class="sr-only" for="where">where</label>
                        <input name="where" id="where" placeholder="location..." class="form-control form-control-lg pl-5">
                        <span class="position-absolute" style="top:0.7rem; left:1.5rem;">
                            @include('svg.searchlocation')
                        </span>
                    </div>
    
    
                    <!-- search-button -->
                    <div class="col-2">
                        <button class="btn btn-secondary btn-lg btn-block" type="submit">
                            search
                        </button>
                    </div>
    
                </div>
                <!-- //row -->
    
            </form>
    
        </div> <!-- //card-body -->
    </div><!-- //card -->
</div>





<!-- ------------------------------------------------------------------------------------------ -->


<script>



</script>