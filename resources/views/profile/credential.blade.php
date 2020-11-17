{{-- ------------------------------------------------------------------------------- --}}


<div id="js-pc-entry">
    <div class="spinner-grower w-100 h-100"></div>
</div>


{{-- ------------------------------------------------------------------------------- --}}

<style>


</style>

{{-- ------------------------------------------------------------------------------- --}}


<script>

    const pcEntry = document.querySelector('#js-pc-entry');

    fetchPcPartial();

    async function fetchPcPartial() {
        let url = new URL('{{url($profile->path())}}');
        url.searchParams.append('section', 'credential');
        await fetch(url)
            .then(res => res.text())
            .then(txt => {
            pcEntry.innerHTML = txt;
            })
            .catch(res => toastIt({title: 'Error', body: res}));

        const pcAddButton = document.querySelector('#js-pc-add-button');
        const pcFormWrapper = document.querySelector('#js-pc-form-wrapper');
        const pcMainWrapper = document.querySelector('#js-pc-main-wrapper');

        pcAddButton.onclick = (event) => {
            event.preventDefault();
            console.log('firing button');
            pcMainWrapper.style.display = 'none';
            pcFormWrapper.innerHTML = 
            `
            <div class="row">
                <div class="col">
                    <form>
                        <div class="card rounded-lg " style="height:25vh;">
                            <div class="card-body text-center d-flex flex-column justify-content-around">
                                <!-- name -->
                                <div class="form-group">
                                    <label for="name" class="sr-only">Certificate</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg"
                                        placeholder="Certificate">
                                </div>
                                <!-- institution -->
                                <div class="form-group">
                                    <label for="institution" class="sr-only">Institution</label>
                                    <input type="text" name="institution" id="institution"
                                        class="form-control form-control-lg" placeholder="Institution">
                                </div>
                                <!-- end_year -->
                                <div class="form-group">
                                    <label for="end_year" class="sr-only">Finish Year</label>
                                    <select class="form-control form-control-lg" id="end_year">
                                        <option selected>Finish Year</option>
                                    </select>
                                </div>

                            </div><!-- //card-bodd -->
                        </div><!-- //card -->
                    </form><!-- //form -->
                </div>
            </div>
            `;
        }
    }

</script>


{{-- ------------------------------------------------------------------------------- --}}