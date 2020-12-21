{{--  --}}



<style>
    .banner-wrapper {
        /* background-image: linear-gradient(to bottom right, rgb(18, 136, 18), darkgreen); */
        background-color: rgb(230, 230, 230);
        text-align: center;
    }

    .banner-wrapper span {
        color: green;
        /* fade in prep */
        opacity: 0;
        transition: 2s ease;
    }
</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="banner-wrapper">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <h2>and yes, of course <span data-js="banner-span">"it's all free!"</span></h2>
            </div>
        </div>
    </div>
</div>



<!-- ---------------------------------------------------------------------------------------- -->


<script>
    function Banner() {
        let bannerSpan = document.querySelector('[data-js="banner-span"]');
        !bannerSpan && console.error('dom query not found');

        window.addEventListener('scroll', fadeInOnScroll);

        function fadeInOnScroll() {
            if (bannerSpan.getBoundingClientRect().bottom - window.innerHeight < 0) {
                bannerSpan.style.opacity = '1';
                window.removeEventListener('scroll', fadeInOnScroll);
            }
        }

    }
    Banner();


</script>