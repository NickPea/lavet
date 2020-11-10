@extends('layouts.app')


@section('main')



<div class="container" style="height: 100vh">
    <div class="row">
        <div class="col-4 offset-4">

            <div id="headers" class="my-4">
                <!-- header one -->
                <div id="js-header-one">
                    <h2 class="font-weight-bold p-0 m-0">Welcome to
                        <span style="color:rgb(228, 115, 102);">
                            {{config('app.name', 'Laravel')}}.
                        </span>
                    </h2>
                    <h5 class="text-muted p-0 m-0 mt-2">Just a few details and we're done.</h5>
                </div>

                <!-- header two -->
                <div id="js-header-two">
                    <h2 class="font-weight-bold p-0 m-0">Welcome to
                        <span style="color:rgb(228, 115, 102);">
                            {{config('app.name', 'Laravel')}}.
                        </span>
                    </h2>
                    <h5 class="text-muted p-0 m-0 mt-2">...Almost there.</h5>
                </div>
            </div>

            <div class="progress" style="height: 5px;">
                <div id="js-progress-bar" class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>


            <div class="card">
                <div class="card-body">

                    <!-- form -->
                    <form id="js-form-wizard" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf


                        <!-- steps -->
                        <div id="js-steps">
                            <!-- step one -->
                            <div id="js-step-one">

                                <!-- image upload -->
                                <div class="form-group">
                                    <div class="image-upload m-1">

                                        @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <label for="js-file-input" id="css-image-upload-overlay-wrapper"
                                            class="position-relative border border-secondary rounded-lg p-1">
                                            <img id="js-file-input-image"
                                                style="height: 100px; width:100px; object-fit: cover"
                                                src={{asset('cat-avatar.jpg')}} />
                                            <div id="css-image-upload-overlay"
                                                class="position-absolute d-flex flex-column justify-content-center align-items-center"
                                                style="top:0; bottom:0; right:0; left:0; background-color:rgba(211, 211, 211, 0.2);">
                                                <h1 class="m-0 display-4 text-muted">&plus;</h1>
                                            </div>
                                        </label>
                                        <input id="js-file-input" type="file" class="visually-hidden" accept="image/*"
                                            name="file" value="{{ old('file') }}" required tabindex="1"/>
                                        <div>
                                            <small>Select a profile image.</small>
                                        </div>

                                    </div>
                                </div>

                                <!-- profile name -->
                                <div class="form-group">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="sr-only" for="name">{{ __('Profile_Name') }}</label>
                                    <input id="name" type="text" class="form-control form-control-lg"
                                        name="name" placeholder="Profile name" value="{{ old('name') }}" required tabindex="2" autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                    <div class="d-flex justify-content-start">
                                        <small>What do we call you?</small>
                                    </div>
                                </div>

                                <!-- work status -->
                                <div class="form-group">
                                    @error('work_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="sr-only" for="work_status">{{ __('Name') }}</label>
                                    <input id="work_status" type="text" class="form-control form-control-lg"
                                        name="work_status" placeholder="Current work status" value="{{ old('work_status') }}" required tabindex="3" autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                    <div class="d-flex justify-content-start">
                                        <small>e.g <q>Looking for work.</q></small>
                                    </div>
                                </div>

                            </div><!-- step one -->

                            <!-- step two -->
                            <div id="js-step-two" class="visually-hidden">

                                <!-- email -->
                                <div class="form-group">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="sr-only" for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control form-control-lg" name="email"
                                        placeholder="Email" value="{{ old('email') }}" required autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="sr-only" for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control form-control-lg"
                                        name="password" placeholder="Password" minlength="8" required autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <!-- password confirm -->
                                <div class="form-group">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="sr-only"
                                        for="password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirmation" type="password"
                                        class="form-control form-control-lg" name="password_confirmation"
                                        placeholder="Confirm password" minlength="8" required autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <!-- legal blurb -->
                                <div class="px-1" style="line-height:1.2;">
                                    <small class="text-muted">Please note you may receive emails and notifications from
                                        us in relation your
                                        user activity on {{config('app.name', 'Laravel')}}, but you can opt out at any
                                        time via your dashboard settings.
                                    </small>
                                </div>


                            </div><!-- //step two -->

                        </div><!-- steps -->

                        <!-- step one: next button -->
                        <div id="js-buttons-one">
                            <div class="d-flex justify-content-end">
                                <div class="form-group">
                                    <button id="js-next-button" class="btn btn-success btn-lg" tabindex="4">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- step two: back and submit buttons -->
                        <div id="js-buttons-two">
                            <div class="d-flex justify-content-end">
                                <div class="form-group mr-auto">
                                    <button id="js-back-button" class="btn btn-outline-secondary btn-lg" tabindex="-1">
                                        {{ __('Back') }}
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button id="js-submit-button" type="submit" class="btn btn-success btn-lg">
                                        {{ __('Create My Profile') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form><!-- // form -->
                </div><!-- //card-body -->
            </div><!-- //card -->

        </div><!-- //col -->
    </div><!-- //row -->
</div><!-- //container -->

@endsection




@section('head')

<style>
    /* form wizard */

    #js-header-one,
    #js-header-two {
        display: none;
    }

    #js-buttons-one,
    #js-buttons-two {
        display: none;
    }

    #js-steps {
        position: relative;
        overflow: hidden;
        height: 300px;
    }

    #js-step-one,
    #js-step-two {
        position: absolute;
        width: 100%;
    }


    /* image overlay */
    #css-image-upload-overlay-wrapper #css-image-upload-overlay {
        opacity: 0;
    }

    #css-image-upload-overlay-wrapper:hover #css-image-upload-overlay {
        opacity: 1;
    }

    #css-image-upload-overlay-wrapper:hover {
        transform: translate(-3px, -3px);
    }

    #css-image-upload-overlay-wrapper:active {
        transform: translate(-1px, -1px);
    }

    /* mdn code for hiding input*/
    .visually-hidden {
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
    }
</style>

@endsection




@push('scripts')

<script>
    'use strict'

    let formWizard = document.querySelector('#js-form-wizard');
    let headerOne = document.querySelector('#js-header-one');
    let headerTwo = document.querySelector('#js-header-two');
    let stepOne = document.querySelector('#js-step-one');
    let stepTwo = document.querySelector('#js-step-two');
    let nextButton = document.querySelector('#js-next-button');
    let backButton = document.querySelector('#js-back-button');
    let submitButton = document.querySelector('#js-submit-button');
    let buttonsOne = document.querySelector('#js-buttons-one');
    let buttonsTwo = document.querySelector('#js-buttons-two');
    let progressBar = document.querySelector('#js-progress-bar');
    


    //setup
    formWizard.elements['js-file-input'].focus();
    headerOne.classList.toggle('d-block');
    buttonsOne.classList.toggle('d-block');

    function toggleSteps() {
        headerOne.classList.toggle('d-block');
        headerTwo.classList.toggle('d-block');
        buttonsOne.classList.toggle('d-block');
        buttonsTwo.classList.toggle('d-block');
        stepOne.classList.toggle('visually-hidden');
        stepTwo.classList.toggle('visually-hidden');
    }

    nextButton.addEventListener('click', (e) => {
        e.preventDefault()
        let stepOneIsValid = formWizard.elements['js-file-input'].checkValidity() && formWizard.elements['name'].checkValidity() && formWizard.elements['work_status'].checkValidity();
        if (stepOneIsValid) {
            toggleSteps();
            progressBar.style.width = '75%';
            formWizard.elements['email'].focus();
        } else {
            formWizard.elements['work_status'].reportValidity();
            formWizard.elements['name'].reportValidity();
            formWizard.elements['js-file-input'].reportValidity();
        }
    });

    backButton.addEventListener('click', (e) => {
        e.preventDefault();
        toggleSteps();
        progressBar.style.width = '25%';

       
    });
    

    formWizard.elements['password_confirmation'].addEventListener('change', (e) => {
        let passwordValue = formWizard.elements['password'].value;
        if (e.target.value !== passwordValue) {
            e.target.setCustomValidity("Passwords do not match");
        } else
            e.target.setCustomValidity("");

    })

    //dirty hack for now to prevent enter key from switching through steps
    formWizard.addEventListener('keypress', (e) => {
        if (e.which === 13) {
            e.preventDefault();
        }
    });
    
    /**
     * Display and show image after selecting
     */
    document.querySelector('#js-file-input').addEventListener('change', (e) => {
        document.querySelector('#js-file-input-image').src = URL.createObjectURL(e.target.files[0]);
        });
</script>


@endpush