{{-- 
    
    
    
--}}
<div class="content-wrapper">

    <!-- title & options -->
    <div class="d-flex">
        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">Bio</h5>

        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('svg.more')
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a id="js-profile-about-edit-button" href="" class="dropdown-item font-weight-bold">Edit</a>
                <a href="" class="dropdown-item font-weight-bold">Action</a>
            </div>
        </div>
    </div>

    <!-- about -->
    <div class="card">
        <div class="card-body">
            <p id="js-profile-about-output" class="m-0">{{$profile->about}}</p>
        </div>
    </div>

    <!-- edit-about -->
    <form id="js-profile-about-form" style="display: none">
        @csrf
        @method('PATCH')
        <div class="d-flex flex-column">
            <div class="form-group">
                <label class="sr-only" for="about">Edit profile about</label>
                <textarea id="js-profile-about-textarea" name="about" id="about" rows="4"
                class="form-control form-control-lg">
                    {{$profile->about}}
                </textarea>
            </div>
            <span class="align-self-end">
                <button class="btn btn-primary">Save</button>
            </span>
        </div>
    </form>

</div><!-- //content-wrapper -->