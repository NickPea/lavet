{{-- ---------------------------------------------------------------------------- --}}


<div id="js-toast-it-entry" class="toast-it-entry"></div>


{{-- ---------------------------------------------------------------------------- --}}

<style>
    .toast-it-entry {
        position: fixed;
        z-index: 9999999;
        right: 5rem;
        top: 5rem;
        width: 20rem
    }

    .toast-it {
        margin-top: 0.2rem;
    }

    .toast-it-close:hover {
        box-shadow: 0 0 0 5px white;
        background: white;
        border-radius: 50%;
    }
</style>

{{-- ---------------------------------------------------------------------------- --}}

<script>
    window.toastIt = (toast) => {
        //toast = {title:string, body:string}     

            let entry = document.querySelector('#js-toast-it-entry')
            let randomId = Math.floor(Math.random()*999999999+111111111);
            entry.innerHTML +=  `
                <div id="toast-it-${randomId}" class="toast-it">
                    <div class="card">
                        <div class="card-header d-flex">
                            ${toast.title}
                            <span onclick="removeToast(${randomId})" class="ml-auto toast-it-close">@include('components.svg-remove')</span>
                        </div>
                        <div class="card-body">
                            ${toast.body}
                        </div>
                    </div>
                </div>
                `;

            window.removeToast = function (toastItRandomId) {
                document.querySelector(`#toast-it-${toastItRandomId}`).remove();
            }

            setTimeout(() => {
                removeToast(randomId);
            }, 3000); 

    }//toastIt

                // toastIt({title: 'hello', body: 'junior'});
                // toastIt({title: 'what', body: 'is it?'});
                // toastIt({title: 'Too', body: 'right!'});


</script>

{{-- ---------------------------------------------------------------------------- --}}
{{-- scratch pad --}}