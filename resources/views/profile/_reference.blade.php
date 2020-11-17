{{-- 
    
    
    
    
    
    
    
--}}


<div class="content-wrapper">

    <div class="d-flex">

        <!-- title -->
        <h5 class="font-weight-light" style="color:grey">References
            ({{$profile->reference->count()}})
        </h5>

        <!-- options -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('components.svg-more')
            </a>
            <!-- dropdown -->
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item font-weight-bold">Action</a>
            </div>
            <a id="js-pr-add-button" href="#" class="options-button">
                @include('components.svg-add')
            </a>
        </div><!-- options -->

    </div><!-- //flex -->

    <!-- provide a reference form -->
    <div class="mt-2">
        @include('profile.add-reference')
    </div>

    <!-- list -->
    <div>

        @forelse ($profile->reference->take(3)->sortDesc() as $reference)

        <!-- item -->
        <div class="rounded-lg mt-2 p-2" style="background-color: rgba(193, 206, 223, 0.3)">

            <!-- quote -->
            <q class="text-center font-weight-light font-italic">{{$reference->body}}</q>

            <!-- provider -->
            <div class="d-flex justify-content-end">
                <a class="text-reset text-decoration-none" href={{secure_url($reference->user->profile->path())}}>
                    <div class="card rounded-lg">
                        <div class="d-flex align-items-center p-1">
                            <img class="rounded m-1" style="width:2rem"
                                src={{asset($reference->user->profile->image->first()->path)}} alt="reference image">
                            <span class="m-1 font-weight-bold">{{$reference->user->name}}</span>
                        </div>
                    </div>
                </a>
            </div>

        </div><!-- // item -->

        @empty
        <p>No references... <a href="">add one!</a></p>
        @endforelse

    </div> <!-- //list -->

</div><!-- //content wrapper -->