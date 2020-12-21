{{--  --}}



<style>
    .latest-wrapper {
        height: 100vh;
        background-color: whitesmoke;
        
    }
</style>

<!-- ---------------------------------------------------------------------------------------- -->


<div class="latest-wrapper">

    <div class="container">
        <div class="row">
            <div class="col-8 py-5">
    
                <h3 class="font-weight-bold">Latest Activity</h3>


                @foreach ($data as $event)
                    <h4>
                        {{$event->title}}
                    </h4>
                @endforeach


    
            </div>
        </div>
    </div>

 


</div>


<!-- ---------------------------------------------------------------------------------------- -->


<script>



</script>