@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6 mx-auto mt-5 card p-5">
        <form action="{{ route('contents.store') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="author">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection