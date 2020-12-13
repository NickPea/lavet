{{--  --}}



<style>
   
    .search-event-back-to-top-button {
        visibility: hidden;
        opacity: 0;
        position: fixed;
        top: 7rem;
        right: 7vw;
        z-index: 100000000;
        border-radius: 50%;
        cursor: pointer;
        transition: 200ms ease-in;
    }

    .search-event-back-to-bottom-button {
        visibility: hidden;
        opacity: 0;
        position: fixed;
        top: 11rem;
        right: 7vw;
        z-index: 100000000;
        border-radius: 50%;
        cursor: pointer;
        transition: 200ms ease-in;
        transform: rotateZ(180deg);
    }

    .search-event-back-to-top-button:hover #svg-top, .search-event-back-to-bottom-button:hover #svg-top {
        fill: white;
    }


</style>



<!-- ---------------------------------------------------------------------------------------- -->

@if ($results->total() != 0)
    

<!-- to top button -->
<div data-js="search-event-back-to-top-button" class="search-event-back-to-top-button">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <button class="btn btn-outline-secondary">
            <span>@include('svg.top')</span>
        </button>
    </div>
</div>

<!-- to bottom button -->
<div data-js="search-event-back-to-bottom-button" class="search-event-back-to-bottom-button">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <button class="btn btn-outline-secondary">
            <span style="transform: rotateY(180deg)">@include('svg.top')</span>
        </button>
    </div>
</div>


@endif


<!-- ---------------------------------------------------------------------------------------- -->



<script>
    function TopBottomButtons() {

        //DOM
        let toTopButton = document.querySelector('[data-js="search-event-back-to-top-button"]');
        let toBottomButton = document.querySelector('[data-js="search-event-back-to-bottom-button"]');

        !toTopButton && console.error('dom query not found');
        !toBottomButton && console.error('dom query not found');

        //EVENTS
        window.addEventListener('scroll', () => {
            if (document.documentElement.scrollTop > 300 || document.body.scrollTop > 300) {
                toTopButton.style.visibility = 'visible';
                toTopButton.style.opacity = '1';
                toBottomButton.style.visibility = 'visible';
                toBottomButton.style.opacity = '1';
            } else {
                toTopButton.style.visibility = 'hidden';   
                toTopButton.style.opacity = '0';
                toBottomButton.style.visibility = 'hidden';   
                toBottomButton.style.opacity = '0';
            }
        });

        toTopButton.addEventListener('click', scrollToTop);
        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        toBottomButton.addEventListener('click', scrollToBottom);
        function scrollToBottom() {
            document.body.scrollTop = document.body.scrollHeight;
            document.documentElement.scrollTop = document.documentElement.scrollHeight;
        }

    }
    window.addEventListener('load', TopBottomButtons);


</script>