{{--  --}}



<style>
    .search-event-back-to-top-button {
        display: none;
        position: fixed;
        top: 3vh;
        right: 7vw;
        z-index: 100000000;
        border-radius: 50%;
        cursor: pointer;
    }

    .search-event-back-to-top-button:hover #svg-top {
        fill: white;
    }


</style>



<!-- ---------------------------------------------------------------------------------------- -->


<div data-js="search-event-back-to-top-button" class="search-event-back-to-top-button">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <button class="btn btn-outline-secondary"><span>@include('svg.top')</span></button>
    </div>
</div>



<!-- ---------------------------------------------------------------------------------------- -->



<script>
    function BackToTop() {
        let button = document.querySelector('[data-js="search-event-back-to-top-button"]');
        !button && console.error('dom query not found');


        window.addEventListener('scroll', () => {
            if (document.documentElement.scrollTop > 300 || document.body.scrollTop > 300) {
                button.style.display = 'block';
            } else {
                button.style.display = 'none';                
            }
        });

        button.addEventListener('click', scrollToTop);

        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            document.querySelector('[data-js="search-event-index-wrapper"]').scrollTop = 0;
        }

    }
    window.addEventListener('load', BackToTop);


</script>