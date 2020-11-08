{{-- 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button> --}}


<!-- Modal -->
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- modal-header -->
                <div class="modal-header">
                    <div>
                        <h2 class="modal-title font-weight-bold p-0 m-0" id="registerModalLabel">Welcome to
                            <span style="color:rgb(228, 115, 102);">
                                {{config('app.name', 'Laravel')}}.</h2>
                        </span>
                        <h5 class="text-muted p-0 m-0">Just a few details and we're done.</h5>
                    </div>
                    <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <h1 aria-hidden="true">&times;</h1>
                    </span>

                </div>

                <!-- modal-body -->
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col">

                                <div class="form-group">
                                    <label class="sr-only" for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control form-control-lg" name="name"
                                        value="{{ old('name') }}" placeholder="Profile Name" required
                                        autocomplete="name" autofocus
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                    <div class="d-flex justify-content-start">
                                        <small>Feel free to include your title, fullname and post-nomial letters if you'd
                                            like.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control form-control-lg" name="email"
                                        value="{{ old('email') }}" placeholder="Email" required autocomplete="email"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control form-control-lg"
                                        name="password" placeholder="Password" required autocomplete="on"
                                        style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control form-control-lg"
                                        name="password_confirmation" placeholder="Confirm password" required
                                        autocomplete="on" style="background-color: rgba(211, 211, 211, 0.3);">
                                </div>

                                <div class="px-1" style="line-height:1.2;">
                                    <small class="text-muted">Please note you may receive emails and notifications from
                                        us in relation your
                                        user activity on {{config('app.name', 'Laravel')}}, but you can opt out at any
                                        time via your dashboard settings.
                                    </small>
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            {{ __('Create My Profile') }}
                                        </button>
                                    </div>
                                </div>


                            </div><!-- //col -->
                        </div><!-- //row -->
                    </div><!-- //container -->
                </div><!-- //modal-body -->

            </div><!-- //modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- //modal -->
</form>


@guest
<div class="card shadow-lg rounded-lg">
    <div class="card-body">

        <form action="/login" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col">
                    <label class="sr-only" for="email">Username</label>
                    <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Email"
                        autocomplete="on" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label class="sr-only" for="password">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" id="password"
                        placeholder="Password" autocomplete="on" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold">Log In</button>

        </form>
        <div class="row my-3">
            <div class="col d-flex justify-content-center">
                <a href={{url('/password/reset')}}>Forgotten password?</a>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center"
                style="border-top: 1px solid lightgrey; padding-top:20px">
                <button class="btn btn-success btn-lg font-weight-bold" data-toggle="modal" data-target="#registerModal"">Sign Up Today</button>
            </div>
        </div>






    </div><!-- //card-body -->
</div><!-- //card -->

@else

<div class=" card shadow-lg rounded-lg">
                    <div class="card-body">



                        <h4>Welcome back</h4>
                        <pre>display image
& buttons
for profile, 
logout,
etc.
</pre>
                        <h2>{{Auth::user()->name}}</h2>



                    </div><!-- //card-body -->
            </div><!-- //card -->

            @endguest