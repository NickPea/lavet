{{--  --}}


<style>


</style>


<!-- ------------------------------------------------------------------------------------------ -->

<!-- searchbar -->
<div class="container my-5">
    <div class="row">
        <div class="col">
            <div class="card search-focus shadow-lg">
                <div class="card-body">


                    <form>

                        <!-- row -->
                        <div class="form-row mb-2">

                            <!-- what -->
                            <div class="position-relative form-group m-0 col-7">
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
                                <input name="where" id="where" placeholder="location..."
                                    class="form-control form-control-lg pl-5">
                                <span class="position-absolute" style="top:0.7rem; left:1.5rem;">
                                    @include('svg.searchlocation')
                                </span>
                            </div>


                        </div>
                        <!-- //row -->

                        <!-- row -->
                        <div class="row">
                            <div class="col d-flex">

                                <!-- search-button -->
                                <div class="ml-auto">
                                    <button class="btn btn-outline-primary btn-lg px-5" type="submit">
                                        <small>search</small>
                                    </button>
                                </div>

                            </div>
                        </div><!-- //row -->


                    </form>

                </div> <!-- //card-body -->
            </div><!-- //card -->
        </div><!-- //col -->
    </div><!-- //row -->
</div><!-- //container -->


<!-- ------------------------------------------------------------------------------------------ -->


<script>



</script>