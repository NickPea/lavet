{{--  --}}






<script>


    function getEarlyResultCount(form) {
        let formData = new FormData(form)

        let url = new URL(`${window.location.origin}/search/event/count`);
        url.searchParams.append('what', formData.get('what'));
        url.searchParams.append('where', formData.get('where'));
        
        return fetch (url)
        .then(res => {
            switch (res.status) {
                case 200:
                    return res.text();
                    break;
                default:
                    throw res;
                    break;
            }
        })
        .catch(res => console.error('getEarlyResultCount()'));
    }

</script>