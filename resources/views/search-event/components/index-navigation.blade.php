{{--  --}}




<style>

    .index-wrapper {
        position:sticky;
        top: 7rem;
        height: 100vh;
        overflow-y: scroll;
        padding: 0 1rem;

    }

    .event-index-image {
        width: 10%;
        height: 10%;
        object-fit: cover;
    }
</style>




<!-- -------------------------------------------------------------------------------- -->


    <div data-js="search-event-index-wrapper" class="index-wrapper">

        <!-- top index boundary -->
        <div style="height: 50px; background-color:lightgrey; border-radius: 0.5rem 0.5rem 0 0"></div>

        @foreach ($results as $event)

        <div id="{{'index-'.$event->id}}" data-intersection-observer="index-card">
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
        </div>

        @endforeach

        <!-- bottom index boundary -->
        <div style="height: 50px; background-color:lightgrey; border-radius: 0 0 0.5rem 0.5rem"></div>

    </div><!-- //index-wrapper -->







<!-- -------------------------------------------------------------------------------- -->


<script>
    function SideNavigation() {

        let indexWrapper = document.querySelector('[data-js="search-event-index-wrapper"]')

        //automatically scroll index to top and bottom of when page scrolled to each end
        window.addEventListener('scroll', () => {
            if (window.scrollY == 0) {
                indexWrapper.scrollTop = 0;
            }
            if (window.scrollY == document.documentElement.scrollHeight - window.innerHeight || window.scrollY == document.body.scrollHeight - window.innerHeight) {
                indexWrapper.scrollTo(0, indexWrapper.scrollHeight);
            }
        });

    }
    SideNavigation();
    
</script>