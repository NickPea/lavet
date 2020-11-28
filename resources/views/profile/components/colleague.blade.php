<style>



</style>


{{-- ------------------------------------------------------------------------------------------------ --}}

<!-- Colleagues // People who you have given references too-->
<div class="content-wrapper">
    <div class="d-flex">
        <h5 class="font-weight-light" style="color:grey">
            Colleagues Reviewed
            ({{$profile->user->reference->map->profile->count()}})</h5>
        <!-- options-dropdown -->
        <div class="btn-group ml-auto">
            <a href="#" class="options-button" data-toggle="dropdown">
                @include('svg.more')
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item font-weight-bold">Action</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse ($profile->user->reference->map->profile->take(8) as $profile)
                <div class="col-3">

                    <div>
                        <a href={{secure_url($profile->path())}}>
                            <img class="img-thumbnail"
                                src={{url($profile->image->first()->path)}}
                                alt="Colleague Image">
                        </a>
                        <a class="text-reset" href={{secure_url($profile->path())}}>
                            <b>{{$profile->user->name}}</b>
                        </a>
                    </div>

                </div>
                @empty
                No Colleagues
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ------------------------------------------------------------------------------------------------ --}}

<script>


    
</script>