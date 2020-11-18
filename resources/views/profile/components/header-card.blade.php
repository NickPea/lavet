<style>


</style>


<!-- Card -->
 <div class="card p-2 rounded-lg shadow-lg">

    <!-- Card Body-->
    <div class="card-body">

        <!-- inner row -->
        <div class="row">
            <!-- inner col 1-->
            <div class="col-5">

                <!-- overlay wrapper -->
                <div class="position-relative">
                    <!-- image -->
                    <a href={{asset($profile->image->first()->path)}}><img class="w-100 rounded"
                            src={{asset($profile->image->first()->path)}}
                            alt="profile image"></a>

                    <!-- image overlay -->
                    <div class="position-absolute" style="top:-5%; left:-5%">

                        <!-- is_free -->
                        <h5>
                            @if ($profile->is_free===1)
                            <span class="badge badge-success border py-2">
                                Online
                            </span>
                            @else
                            <span class="badge badge-secondary border py-2">
                                Offline
                            </span>
                            @endif
                        </h5>

                    </div>
                    <!-- end image overlay -->
                </div>
                <!-- end overlay wrapper -->

            </div>
            <!-- end inner col 1 -->

            <!-- inner col 2 -->
            <div class="col">

                <!-- name, field & position -->
                <div class="h-100 d-flex flex-column justify-content-end">
                    <h3 class="font-weight-bold">
                        {{$profile->user->name}}
                    </h3>
                    <div>
                        <h6 class="text-muted font-weight-lighter">
                            {{$profile->field->implode('name', ', ')}}
                        </h6>
                        <h5 class="text-secondary">
                            {{$profile->position->implode('name', ', ')}}
                        </h5>
                    </div>
                   
                </div>

            </div><!-- end inner col 2 -->
        </div> <!-- inner row -->

        <div class="row mt-4">
            <div class="col">
                <h5 class="m-0"><i>"{{$profile->work_status}}"</i></h5>
            </div>
        </div>

    </div> <!-- end card body -->

</div> <!-- end card -->


<script>

    
</script>