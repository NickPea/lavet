@extends('layouts.app')

@section('title')
Welcome
@endsection

@section('main')




<style>
    .hover:hover {
        background-color: rgba(211, 211, 211, 0.1);
        box-shadow: 0 0 20px 5px rgba(211, 211, 211, 0.5);
        transform: translateY(-2px);
        transition: 50ms ease-in;
    }

    .search-focus:focus-within {
        background-color: rgba(211, 211, 211, 0.1);
        box-shadow: 0 0 20px 5px rgba(211, 211, 211, 0.5);
        transform: translateY(-2px);
        transition: 50ms ease-in;
    }
</style>



{{-- 
<div class="container">
    <div class="row" style="height:60vh;">
        <!-- header -->
        <div class="col offset-1 d-flex flex-column justify-content-center">
            <div>
                <h1 class="display-3" style="color:lightsalmon;">La`Vet</h1>
                <h3 class="font-weight-bold">Build <u>`your</u> Veterinary Network
                </h3>
                <h5 class="text-muted">...the easy way.</h5>
            </div>
        </div>
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <a href="/register" class="mt-5 btn btn-primary btn-lg">Sign Up Today</a>
        </div>
    </div>
</div> --}}




<!-- searchbar -->
<div class="container my-4">
    <div class="row">
        <div class="col">
            @include('search.searchbar')
        </div>
    </div>
</div>




<!-- index -->
<div class="container my-4">
    <!-- row 1 -->
    <div class="row">
        <div class="col">

            <div class="row">
                @foreach ($data->flatten() as $model)

                @switch(get_class($model))
                @case('App\Profile')

                <div class="col-3">
                    @include('components/profile-card')
                </div>

                @break
                @case('App\Listing')

                <div class="col-3">
                    @include('components/listing-card')
                </div>

                @break
                @case('App\Event')

                <div class="col-3">
                    @include('components/event-card')
                </div>


                @break
                @default

                @endswitch
                @endforeach
            </div>


        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end container -->


@endsection
<!-- end main -->