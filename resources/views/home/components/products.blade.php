{{--  --}}



<style>
    .products-wrapper {
        /* height: 100vh; */
        background-color: whitesmoke;
    }

    .fake-link {
        color: darkblue;
    }

    .product:hover .fake-link {
        color: rgb(0, 128, 255);
    }
</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="products-wrapper">

        <div class="container">
            <div class="row h-100">
    
                <div class="col-4 py-5">
    
                    <a href="register" class="product text-reset text-decoration-none">
                        <div class="d-flex flex-column justify-content-start align-items-center">
                            <div class="w-25">
                                @include('svg.face')
                            </div>
                            <h3 class="card-title">Join Up</h3>
                            <p class="card-text text-center">Take a minute to join the industry <br> by sharing a few
                                details</p>
                            <h5 class="fake-link">Register</h5>
                        </div>
                    </a>
    
                </div>
    
                <div class="col-4 py-5">
    
                    <a href="search/profile" class="product text-reset text-decoration-none">
                        <div class="d-flex flex-column justify-content-start align-items-center">
                            <div class="w-25">
                                @include('svg.connect')
                            </div>
                            <h3 class="card-title">Network</h3>
                            <p class="card-text text-center">Talk directly or join in on group dicussions <br> with regular
                                veterinary members <br> from all around the world</p>
                            <h5 class="fake-link">Find People</h5>
                        </div>
                    </a>
    
                </div>
    
                <div class="col-4 py-5">
    
                    <a href="search/event" class="product text-reset text-decoration-none">
                        <div class="d-flex flex-column justify-content-start align-items-center">
                            <div class="w-25">
                                @include('svg.group')
                            </div>
                            <h3 class="card-title">& Come Along</h3>
                            <p class="card-text text-center">Get involved and stay up-to-date <br> by meeting up with other
                                industry members <br> at the latest veterinary events.</p>
                            <h5 class="fake-link">Attend Now</h5>
                        </div>
                    </a>
    
                </div>
    
            </div><!-- //row -->
        </div>

</div><!-- //products-wrapper -->


<!-- ---------------------------------------------------------------------------------------- -->


<script>



</script>