{{--  --}}




<style>
    * {
        scroll-behavior: smooth;
    }

    .sticky-nav {
        position: sticky;
        top: 0;
    }

    .index-wrapper {
        height: 100vh;
        overflow-y: scroll;
        padding: 1rem;
    }

    .event-index-image {
        width: 10%;
        height: 10%;
        object-fit: cover;
    }
</style>




<!-- -------------------------------------------------------------------------------- -->


<div class="sticky-nav">
    <div data-js="search-event-index-wrapper" class="index-wrapper">

        <!-- top index boundary -->
        <div style="height: 50px; background-color:lightgrey; border-radius: 0.5rem 0.5rem 0 0"></div>

        @foreach ($results as $event)

        <a href="#{{$event->id}}" class="text-decoration-none text-reset">

            <div class="card my-2 hover">
                <div class="card-body">

                    <div class="row">
                        <div class="col">


                            <div class="d-flex p-1">
                                <img src="{{$event->image->first()->path}}" alt="" class="event-index-image">
                                <div class="d-flex flex-column align-items-start ml-2">
                                    <h6 class="m-0">{{$event->title}}</h6>
                                    <small
                                        class="mt-auto text-muted">{{$event->start_at->format('D, M d, g:ma')}}</small>
                                </div>
                            </div>



                        </div><!-- //col -->
                    </div><!-- //row -->

                </div>
            </div>

        </a>

        @endforeach

        <!-- bottom index boundary -->
        <div style="height: 50px; background-color:lightgrey; border-radius: 0 0 0.5rem 0.5rem"></div>

    </div><!-- //index-wrapper -->


</div>





<!-- -------------------------------------------------------------------------------- -->


<script>
    function SideNavigation() {

        // let blah = document.querySelector('[data-js="search-event-side-nav"]')
        // !blah && console.error('dom query not found')

    }
    SideNavigation();
    
</script>