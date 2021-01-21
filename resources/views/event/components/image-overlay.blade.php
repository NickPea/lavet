{{--  --}}

<style></style>

{{-- ------------------------------------------------------------------------------------------ --}}


<!-- Image and Overlay -->
<div class="card p-2 rounded-lg shadow-lg">
    <div class="card-body">
        <!-- overlay wrapper -->
        <div class="position-relative">
            <!-- image -->
            <img class="w-100 rounded" src={{asset($event->image->first()->path)}} alt="event image">
            <!-- image overlay -->
            <div class="position-absolute" style="bottom:3%; left:3%">
                <!-- tags -->
                @forelse ($event->tag->map->name as $tag)
                <h4>
                    <div class="badge badge-success border py-2">
                        {{$tag}}
                    </div>
                </h4>
                @empty
                @endforelse
            </div><!-- end image overlay -->
        </div><!-- end overlay wrapper -->
    </div> <!-- end card body -->
</div> <!-- end card -->


{{-- ------------------------------------------------------------------------------------------ --}}


<script></script>