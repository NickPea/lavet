@extends('layouts.app')

@section('title')
Welcome
@endsection

@section('main')


<!-- index -->
<div class="container my-4">
    <h3>index:</h3>
    @foreach ($data as $category)
        @foreach ($category as $model)
            <a 
            class="p-1"
            href={{$model->path()}}>
                {{$model->path()}}
            </a>
        @endforeach
    @endforeach
</div>

<div class="" style="display:flex; color:lightsalmon; justify-content:center; height:50vh; align-items:center;">
    <h1 style="font-size:5rem">La`Vet</h1>
</div>

@endsection
<!-- end main -->