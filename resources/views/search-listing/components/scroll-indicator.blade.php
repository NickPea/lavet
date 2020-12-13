{{--  --}}




<style>

.search-event-scroll-indicator{
    position:sticky;
    position:-webkit-sticky;
    top:0;
    z-index: 500;
    height: 5px;
    width: 0%;
    background: grey;
}


</style>



<!-- ------------------------------------------------------------------------------------------- -->

@if ($results->total() != 0)

<div data-js="scroll-indicator" class="search-event-scroll-indicator"></div>
        
@endif
    




<!-- ------------------------------------------------------------------------------------------- -->



<script>

 
    function ScrollIndicator() {
        
        let scrollProgressBar = document.querySelector('[data-js="scroll-indicator"]')
        !scrollProgressBar && console.error('dom query not found');

        window.addEventListener('scroll', () => {

            let scrollPosition = document.documentElement.scrollTop;
            let pageHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrollPercentage = scrollPosition/pageHeight * 100;

            scrollProgressBar.style.width = `${scrollPercentage}%`;

        });

    }
    ScrollIndicator();



</script>