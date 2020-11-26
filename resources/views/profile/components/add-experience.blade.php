<!-- add experience -->
<div class="card">
    <div class="card-body">
        <form id="js-pe-add-form">
            @csrf
            
            <!-- current position -->
            <div class="mb-2 form-check">
                <input id="js-pe-checkbox" class="form-check-input" type="checkbox" name="current_position">
                <label class="form-check-label" for="defaultCheck1">
                    Current position
                </label>
              </div>
            <!-- role -->
            <div class="form-group">
                <label class="sr-only" for="work_role">Role</label>
                <input class="form-control form-control-lg" type="text" name="work_role" id="work_role"
                    placeholder="Role" required>
            </div>
            <!-- organisation -->
            <div class="form-group">
                <label class="sr-only" for="organisation">Organisation</label>
                <input class="form-control form-control-lg" type="text" name="organisation" id="organisation"
                    placeholder="Organisation" required>
            </div>
            <div class="row">
                <!-- from -->
                <div class="form-group col-6">
                    <label for="start_at">
                        <h5 class="font-weight-bold text-secondary ml-3 m-0">
                            From
                        </h5>
                    </label>
                    <input class="form-control form-control-lg" type="month" name="start_at" id="start_at"
                        placeholder="Started">
                </div>
                <!-- to -->
                <div id="js-pe-date-to" class="form-group col-6">
                    <label for="end_at">
                        <h5 class="font-weight-bold text-secondary ml-3 m-0">
                            To
                        </h5>
                    </label>
                    <input class="form-control form-control-lg" type="month" name="end_at" id="end_at"
                        placeholder="Ended">
                </div>
            </div>
            <!-- buttons -->
            <hr>
            <div class="d-flex justify-content-end">
                <button id="js-pe-add-form-cancel" type="reset" class="btn btn-outline-secondary btn-lg" tabindex="-1">cancel</button>
                <button id="js-pe-add-form-save" class="ml-2 btn btn-primary btn-lg">save</button>
            </div>
        </form>

    </div>
</div>