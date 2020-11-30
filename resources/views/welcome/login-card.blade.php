{{--  --}}



<style>



</style>



{{-- ------------------------------------------------------------------------------------------ --}}



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
                <a href="/register" class="btn btn-success btn-lg font-weight-bold">Sign Up Today</a>
                {{-- <button class="btn btn-success btn-lg font-weight-bold" data-toggle="modal" data-target="#registerModal"">Sign Up Today</button> --}}
            </div>
        </div>

    </div><!-- //card-body -->
</div><!-- //card -->



{{-- ------------------------------------------------------------------------------------------ --}}



<script>



</script>
