
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($contents as $content)
            <div class="col-md-4">
                <div class="card mb-3" style="">
                    <img src="{{ asset("storage/gallery/".$content->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $content->title }}</h5>
                      <p>{{ $content->author }}</p>
                      <p class="card-text">{{ $content->content }}</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection