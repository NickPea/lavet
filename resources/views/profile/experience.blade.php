{{-- ---------------------------------------------------------------------------- --}}

<div id="js-pe-partial">
    <div class="spinner-border"></div>
</div>



{{-- ---------------------------------------------------------------------------- --}}

<script>
    "use strict"

        let pePartial = document.querySelector('#js-pe-partial');

        refreshPartial();

        async function refreshPartial() {
            let url = new URL('{{url($profile->path())}}');
            url.searchParams.append('section', 'experience');
            await fetch(url)
            .then(data => data.text())
            .then(data => pePartial.innerHTML = data);
            
            let addButton = document.querySelector('#js-pe-add-button');
            let addEntry = document.querySelector('#js-pe-add-entry');
            let addForm = document.querySelector('#js-pe-add-form');
            let explist = document.querySelector('#js-pe-list');
            let cancelButton = document.querySelector('#js-pe-add-form-cancel');
            let saveButton = document.querySelector('#js-pe-add-form-save');
            let peCheckbox = document.querySelector('#js-pe-checkbox');
            let peDateTo = document.querySelector('#js-pe-date-to');

            peCheckbox.addEventListener('change', (e) => {
                if (peCheckbox.checked === true) {
                    peDateTo.style.display = 'none'
                } else {
                    peDateTo.style.display = 'block';
                }
            })
            
            addButton.addEventListener('click', (e) => {
                e.preventDefault();
                addEntry.style.display === 'none'? addEntry.style.display = 'block': addEntry.style.display = 'none';
                explist.style.display === 'none'? explist.style.display = 'block' : explist.style.display = 'none';
            });
            cancelButton.addEventListener('click', (e) => {
                e.preventDefault();
                addForm.reset();
                addEntry.style.display = 'none';
                explist.style.display = 'block'
            });
            addForm.addEventListener('submit', (e) => {
                e.preventDefault();

                let url = new URL('{{url($profile->path()."/experience")}}')
                let formData = new FormData(addForm);

                if (formData.has('current_position')){
                    formData.set('end_at', '');
                    formData.delete('current_position');
                }

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(res => {
                    switch (res.status) {
                        case 422:
                            return Promise.reject(`Experience: ${res.status} - invalid input`);
                            break;
                        case 201 :
                            res.json().then(obj => {
                                console.log('Added Exp', obj);
                                refreshPartial();
                            })
                            break;
                        default:
                            return Promise.reject('Fetch error: response not 422, nor 201')
                            break;
                    }
                })
                .catch(err => console.log(err));
                
                
            });

        }//refreshPartial

        function removeExperience(id) {
                event.preventDefault();
                let url = new URL(`{{url('experience')}}/${id}`);
                let formData = new FormData();
                formData.append('_method', 'DELETE');
                formData.append('_token', '{{csrf_token()}}');
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(json => console.log(json))
                .then(() => refreshPartial())
            }

</script>