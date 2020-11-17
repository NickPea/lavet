{{--  --}}



<div data-js="location">
    <div class="spinner-border"></div>
</div>

<style></style>

<script>
    function Location() {
        let entry = document.querySelector('[data-js="location"]');
        !entry&&console.error('location entry null');
        //fetch
        let url = new URL(`${window.location.href}?section=location`);
        fetch(url).then(res => res.text()).then(locationPartial => {
            entry.innerHTML = locationPartial;
        })
        //render
    }
    Location();
</script>