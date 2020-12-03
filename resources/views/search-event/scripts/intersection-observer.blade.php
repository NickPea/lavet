{{--  --}}


<style>

    .index-active {
        box-shadow: 0 0 0px 5px lightgrey;
    }

</style>


<!-- ------------------------------------------------------------------------------------------ -->


<script>

    /**
     * on scroll over result cards, highlight associated index card in side-navigation
     */

    function IndexScrollObserver(params) {
        
        let resultCards = document.querySelectorAll('[data-intersection-observer="result-card"]');
        let indexCards = document.querySelectorAll('[data-intersection-observer="index-card"]');
        // let indexWrapper = document.querySelector('[data-js="search-event-index-wrapper"]')

        resultCards.length == 0 && console.error('dom query not found');
        indexCards.length == 0 && console.error('dom query not found');
        // !indexWrapper && console.error('dom query not found');

        

        let io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    let assocIndex = Array.from(indexCards).find(elem => elem.id == `index-${entry.target.id}`)
                    assocIndex.classList.add('index-active');
                    // indexWrapper.scrollTo(0, assocIndex.offsetTop - 3 * assocIndex.offsetHeight);
                } else {
                    let assocIndex = Array.from(indexCards).find(elem => elem.id == `index-${entry.target.id}`)
                    assocIndex.classList.remove('index-active');                }
            });
        }, {threshold: 0.5});
        
        resultCards.forEach(result => {
            io.observe(result);
        });

    }
    window.addEventListener('load', IndexScrollObserver);

</script>


