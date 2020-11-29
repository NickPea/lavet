{{--  --}}



<style>




</style>



{{-- -------------------------------------------------------------------------------------------------------------- --}}



<div class="content-wrapper">

    {{-- START --}}



    <!-- title & options -->
    <div class="d-flex mb-2">

        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">References
            ({{$profile->reference->count()}})
        </h5>

        <!-- options -->
        <div class="btn-group ml-auto">
            <a data-js="profile-reference-add-button" href="#" class="options-button">
                @include('svg.add')
            </a>
        </div><!-- options -->

    </div><!-- //flex -->



    <!-- ------------------------------------------------------------------------------------------------------------ -->


    {{-- HIDDEN FORM / APPEND/REPLACE --}}


    <div data-js="profile-reference-add-form-wrapper" class="mb-3" style="display: none">


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <form data-js="profile-reference-add-form">
                            <!-- tokens -->
                            @csrf
                            @method('PUT')

                            <!-- input -->
                            <div class="form-group">
                                <label class="sr-only" for="pr_body">Add a reference</label>
                                <textarea class="form-control form-control-lg" style="resize: none;" id="pr_body"
                                    name="body" rows="2" required
                                    placeholder="{{"\"{$profile->user->name} is...\""}}"></textarea>
                            </div>

                            <!-- provider image card -->
                            @auth
                            <div class="d-flex justify-content-end mt-2">
                                <div class="card rounded-lg">
                                    <div class="d-flex align-items-center p-1">
                                        <img class="rounded m-1" style="width:2rem"
                                            src={{asset(Auth::user()->profile->image->first()->path)}}
                                            alt="reference image">
                                        <span class="m-1 font-weight-bold">{{Auth::user()->name}}</span>
                                    </div>
                                </div>
                            </div>
                            @endauth

                            <hr>

                            <!-- submit -->
                            <div class="d-flex justify-content-end mt-2">
                                <button data-js="profile-reference-add-form-cancel" class="btn btn-outline-secondary btn-lg">cancel</button>
                                <button class="btn btn-primary btn-lg ml-2" type="submit">
                                    save
                                </button>
                            </div>

                            <small>Note: one reference per person.</small>


                        </form>

                    </div><!-- //card-body -->
                </div><!-- //card -->

            </div><!-- //col -->
        </div><!-- //row -->


    </div><!-- //form-wrapper -->


    <!-- ------------------------------------------------------------------------------------------------------------ -->


    {{-- DISPLAY --}}
    <div data-js="profile-reference-display-wrapper">

        <div data-js="profile-reference-display">
            {{-- entry --}}
        </div>

    </div>



    {{-- END --}}

</div><!-- //content wrapper -->

{{-- -------------------------------------------------------------------------------------------------------------- --}}




<script>
    "use strict"
    
    function ProfileReference() {


        
        //DOM
        let refDisplayWrapper = document.querySelector('[data-js="profile-reference-display-wrapper"]');
        let refDisplay = document.querySelector('[data-js="profile-reference-display"]');
        let refAddButton = document.querySelector('[data-js="profile-reference-add-button"]');

        let refAddFormWrapper = document.querySelector('[data-js="profile-reference-add-form-wrapper"]');
        let refAddForm = document.querySelector('[data-js="profile-reference-add-form"]');
        let refAddFormCancel = document.querySelector('[data-js="profile-reference-add-form-cancel"]');



        !refDisplayWrapper && console.error('dom query not found')
        !refDisplay && console.error('dom query not found')
        !refAddButton && console.error('dom query not found')
        !refAddFormWrapper && console.error('dom query not found')

        //EVENTS
        refAddButton.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-reference-add-form/toggle'})
        });

        refAddFormCancel.addEventListener('click', () => {
            event.preventDefault();
            store.publish({type: 'profile-reference-add-form/toggle'})
        });

        refAddForm.addEventListener('submit', async () => {
            event.preventDefault();
            await updateOrCreateProfileReference(refAddForm)
            refreshProfileReference();
            store.publish({type: 'profile-reference-add-form/toggle'})
        });


        //RENDER


        function renderReferenceAddForm(oldState, newState) {
            if (!_.isEqual(oldState.showReferenceAddForm, newState.showReferenceAddForm)) {
                if (newState.showReferenceAddForm) {
                    refAddFormWrapper.style.display = "block";
                } else {
                    refAddFormWrapper.style.display = "none";
                }
            }
        }
        store.subscribe(renderReferenceAddForm);


        function renderReference(oldState,newState) {
            if(!_.isEqual(oldState.reference.items, newState.reference.items)) {
                //1.transform data
                let mappedReferences = newState.reference.items.map(ref => {
                    return (`
                        <!-- item -->
                        <div class="rounded-lg mb-2 p-2" style="background-color: rgba(193, 206, 223, 0.3)">

                            <!-- quote -->
                            <q class="text-center font-weight-light font-italic">
                                {{-- {{$reference->body}} --}}
                                ${ref.body}
                            </q>
                            <span>${ref.date}</span>

                            <!-- user -->
                            <div class="d-flex justify-content-end">
                                <a class="text-reset text-decoration-none" 
                                {{-- href={{secure_url($reference->user->profile->path())}}> --}}
                                    href="${window.location.origin}/${ref.userProfilePath}">
                                    <div class="card rounded-lg">
                                        <div class="d-flex align-items-center p-1">
                                            <img class="rounded m-1" style="width:2rem"
                                                {{-- src={{asset($reference->user->profile->image->first()->path)}}  --}}
                                                src="${ref.userProfileImagePath}">
                                            <span class="m-1 font-weight-bold">
                                                {{-- {{$reference->user->name}} --}}
                                                ${ref.userName}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div><!-- // item -->
                    `)
                });//endmap
                
                //2.append to entry
                refDisplay.innerHTML = mappedReferences.join('');

                //3.add event listeners



            }//endif

        }
        store.subscribe(renderReference);

    }
    ProfileReference();
</script>