<!-- provide a reference form -->
<form id="js-pr-add-form">
    @csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- input -->
                    <div class="form-group">
                        <label class="sr-only" for="pr_body">Add a reference</label>
                        <textarea class="form-control form-control-lg" style="resize: none;" id="pr_body"
                                name="body" rows="2" required placeholder="{{"\"{$profile->user->name} is...\""}}"></textarea>
                    </div>

                    <!-- provider image card -->
                    @auth
                    <div class="d-flex justify-content-end mt-2">
                        <div class="card rounded-lg">
                            <div class="d-flex align-items-center p-1">
                                <img class="rounded m-1" style="width:2rem"
                                    src={{asset(Auth::user()->profile->image->first()->path)}} alt="reference image">
                                <span class="m-1 font-weight-bold">{{Auth::user()->name}}</span>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <hr>

                    <!-- submit -->
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-outline-secondary btn-lg">cancel</button>
                        <button class="btn btn-primary btn-lg ml-2" type="submit">save</button>
                    </div>

                </div><!-- //card-body -->
            </div><!-- //card -->

        </div><!-- //col -->
    </div><!-- //row -->
</form>