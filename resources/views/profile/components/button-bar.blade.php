{{--  --}}


<style>



</style>


<!-- --------------------------------------------------------------------------------------------------------- -->


<div class="d-flex justify-content-end">

    <div class="btn-group">
        <!-- more -->
        <button class="btn btn-outline-secondary btn-lg ml-2 dropdown-toggle" data-toggle="dropdown">
            <span>@include('svg.more')</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <h6 class="dropdown-header">More options</h6>
            <button class="dropdown-item" type="button">
                <span>@include('svg.report')</span>
                <span>Report User</span>
            </button>
            {{-- <button class="dropdown-item" type="button">Block</button> --}}
        </div>
    </div>
    
    <!-- share -->
    <button class="btn btn-outline-secondary btn-lg ml-2 ">
        <span>@include('svg.share')</span>
        {{-- <span>Share</span> --}}
    </button>

    <!-- message -->
    <button class="btn btn-outline-success btn-lg btn-block ml-2">
            <span>Contact</span>
            {{-- <span class="ml-2">@include('svg.send')</span> --}}
    </button>


</div>


<!-- --------------------------------------------------------------------------------------------------------- -->


<script>




</script>