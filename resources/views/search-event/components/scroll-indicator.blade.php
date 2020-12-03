{{--  --}}




<style>

div[data-js="scroll-indicator"] {
    position: sticky;
    top: 0;
    z-index: 99999999999;
    height: 7px;
    width: 0%;
    background: linear-gradient(270deg, lightsalmon, salmon);
}


</style>



<!-- ------------------------------------------------------------------------------------------- -->



<div data-js="scroll-indicator"></div>




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