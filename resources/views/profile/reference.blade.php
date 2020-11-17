{{-- 
    




--}}

<div id="js-pr-partial">
    <div class="spinner-border"></div>
</div>


<script>
    "use strict"
    {
        let prPartial = document.querySelector('#js-pr-partial');

        refreshPRPartial();

        async function refreshPRPartial() {
            let url = new URL("{{ url($profile->path()) }}");
            url.searchParams.append('section', 'reference');
            await fetch(url)
            .then(res => res.text())
            .then(res => prPartial.innerHTML = res)
            .catch(res => console.log(res));

            let prAddForm = document.querySelector('#js-pr-add-form');

            prAddForm.addEventListener('submit', (e) => {
                e.preventDefault();
                let url = new URL('{{ url($profile->path()."/reference") }}' );
                let formData = new FormData(prAddForm);
                fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(res => {
                    switch (res.status) {
                        case 403:
                            res.text().then(text => toastIt({title: res.status, body: text}));
                            break;
                        case 201:
                            res.json().then(json => console.log(json)).then(()=> refreshPRPartial());
                            break;
                        default:
                            throw res;
                            break;
                    }
                })
                .catch(err => err.text().then(txt => alert(txt)));

            });
        }
    }
</script>