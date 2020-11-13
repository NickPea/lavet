<div class="content-wrapper">
    <div class="d-flex">
        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">Experience
            ({{$profile->experience->count()}})
        </h5>

        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('components.svg-more')
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a id="js-profile-experience-add-button" href="#" class="dropdown-item font-weight-bold">Add</a>
                <a href="#" class="dropdown-item font-weight-bold">Action</a>
            </div>
            <a id="js-pe-add-button" class="options-button">
                @include('components.svg-add')
            </a>
        </div>
    </div>

    <!-- experiences -->
    <div id="js-pe-add-entry" style="display: none">
        @include('profile.add-experience')
    </div>

    <div id="js-pe-list">

        @forelse ($profile->experience->sortDesc()->take(3) as $experience)

        @include('profile.experience-list-item')

        @empty

        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="m-0">No experience recorded</p>
                </div>
            </div>
        </div>

        @endforelse

    </div><!-- //js-pe-list -->

</div><!-- //content-wrapper -->