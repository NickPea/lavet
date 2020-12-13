{{--  --}}



<style>
    .image-background {
        background: url('https://lavet.test/front-header.jpg') no-repeat;
        background-size: cover;
    }

    .image-shade {
        background-color: rgba(0, 0, 0, 0.6);
        height: 80vh;
        width: 100%;
    }
</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="position-relative w-100 image-background" style="height: 80vh">
    <div class="image-shade"></div>

    <div class="position-absolute w-100 h-100" style="top:0; z-index:9999999;">
        <div class="row h-25">
            <div class="col h-100">

                <div class="d-flex justify-content-center align-items-center text-white p-5 h-100">

                    <div class="d-flex align-items-center">
                        <h2>
                            @include('svg.cafe-white')
                            <i>Cafe</i>
                            Vet
                        </h2>
                    </div>

                    <a class="text-reset ml-5" href="search/event">events</a>
                    <a class="text-reset ml-5" href="search/listing">jobs</a>
                    <a class="text-reset ml-5" href="search/profile">people</a>

                    <button href="/register" class="btn btn-outline-success text-white ml-auto">Join In</button>
                    <a href="/login" class="text-reset ml-5">Login</a>

                </div>

            </div><!-- //col -->
        </div><!-- //row -->

        <div class="row h-75">
            <div class="col h-100">
                    <div class="d-flex justify-content-center align-items-end h-100 p-5">
                        <h1 class="text-white">Where the veterinary community comes together.</h1>
                    </div>
            </div><!-- //col -->
        </div><!-- //row -->

    </div><!-- //overlay -->


</div>


<!-- ---------------------------------------------------------------------------------------- -->


<script>



</script>