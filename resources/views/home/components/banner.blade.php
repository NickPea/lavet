{{--  --}}



<style>


.banner-wrapper {
        /* background-image: linear-gradient(to bottom right, rgb(18, 136, 18), darkgreen); */
        background-color: white;
        padding: 5rem;
        text-align: center;
    }
.banner-wrapper > * {
    margin: 0;
}
.banner-wrapper span {
    color: green;
    font-weight: 500;

    /* fade in prep */
    opacity: 0;
    transition: 2s;
}

</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="banner-wrapper">
    <h2>and yes, <span data-js="banner-span">it's all Free!</span></h2>
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