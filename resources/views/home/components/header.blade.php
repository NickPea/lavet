{{--  --}}



<style>
    .image-background {
        background: url('https://lavet.test/front-header.jpg') no-repeat;
        background-size: cover;
    }

    .image-shade {
        background-color: rgba(0, 0, 0, 0.6);
        height: 100%;
        width: 100%;
    }

    .header-title {
        opacity: 0;
        transform: translateY(20px);
        transition: 1s;
    }

</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="position-relative w-100 image-background" style="height: 70vh">
    <div class="image-shade"></div>

    <div class="position-absolute w-100 h-100" style="top:0; z-index:9999999;">
        <div class="container h-100">
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
    
                        <a class="text-reset ml-5" href="search/profile">people</a>
                        <a class="text-reset ml-5" href="search/listing">placements</a>
                        <a class="text-reset ml-5" href="search/event">events</a>
                        {{-- <a class="text-reset ml-5" href="search/forum">forums</a> --}}
    
                        <a href="/register" class="btn btn-outline-success text-white ml-auto">Join Up</a>
                        <a href="/login" class="text-reset ml-5">Login</a>
    
                    </div>
    
                </div><!-- //col -->
            </div><!-- //row -->
    
            <div class="row h-75">
                <div class="col h-100">
                    <div class="d-flex justify-content-end align-items-start h-100 px-5">
                        <h1 data-js="header-title" class="header-title text-white text-right">Where the <br><u>Veterinary</u> <br> industry <br> meets.</h1>
                    </div>
                </div><!-- //col -->
            </div><!-- //row -->
        </div>

    </div><!-- //overlay -->


</div>


<!-- ---------------------------------------------------------------------------------------- -->


<script>
    function Header() {
        let headerTitle = document.querySelector('[data-js="header-title"]');
        !headerTitle && console.error('dom query not found');

        window.addEventListener('load', fadeInHeaderTitleOnLoad);

        function fadeInHeaderTitleOnLoad() {
                headerTitle.style.opacity = '1';
                headerTitle.style.transform = 'translateY(0)';
        }

    }
    Header();



</script>