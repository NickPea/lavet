{{-- ------------------------------------------------------------------------------------ --}}


<div id="js-profile-about-include">
    <div class="spinner-border"></div>
</div>


{{-- ------------------------------------------------------------------------------------ --}}

<script>
    "use strict"
    {
        function getFreshPartial(section) {
            let url = new URL('{{url($profile->path())}}')
            url.searchParams.append('section', section)
            return (fetch(url).then(data => data.text()));
        }

        async function setupFreshPartial() {
            
            let include = document.querySelector('#js-profile-about-include');
            
            include.innerHTML = await getFreshPartial('about');

            let form = document.querySelector('#js-profile-about-form');
            let output = document.querySelector('#js-profile-about-output');
            let editbutton = document.querySelector('#js-profile-about-edit-button');

            editbutton.addEventListener('click', (e) => {
                e.preventDefault();
                form.style.display = 'block';
                output.parentElement.parentElement.style.display = 'none';
                editbutton.style.display = 'none';
            });

            async function updateAndRefresh() {
                let url = new URL('{{url($profile->path())}}');
                let formData = new FormData(form);
                await fetch(url, {
                    method: 'POST',
                    body: formData,
                }).then(data => console.log(data.ok?'About Updated': 'Error on update'));
                setupFreshPartial();
            }


            form.addEventListener('submit', (e) => {
                e.preventDefault();
                updateAndRefresh();
            });
        }

        window.onload = setupFreshPartial();

    }
</script>