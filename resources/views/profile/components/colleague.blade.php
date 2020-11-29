<style>



</style>


{{-- ------------------------------------------------------------------------------------------------ --}}

<!-- Colleagues // People who you have given references too-->
<div class="content-wrapper">

    <!-- title -->
    <div>

        <h5 class="font-weight-light" style="color:grey">
            Colleagues Reviewed
            ({{$profile->user->reference->map->profile->count()}})
        </h5>

    </div>

    <!-- ------------------------------------------------------------------------------------------ -->

    {{-- DISPLAY --}}
    <div class="card">
        <div class="card-body">
            <div class="row">


                @forelse ($profile->user->reference->map->profile->take(8) as $profile)
                <div class="col-3">

                    <div>
                        <a href={{secure_url($profile->path())}}>
                            <img class="img-thumbnail" src={{url($profile->image->first()->path)}}
                                alt="Colleague Image">
                        </a>
                        <a class="text-reset font-weight-bold" href={{secure_url($profile->path())}}>
                            {{$profile->user->name}}
                        </a>
                    </div>

                </div>
                @empty
                No Colleagues
                @endforelse


            </div><!-- //row -->
        </div><!-- //card-body -->
    </div><!-- //card -->


</div><!-- content-wrapper -->

{{-- ------------------------------------------------------------------------------------------------ --}}

<script>



</script>