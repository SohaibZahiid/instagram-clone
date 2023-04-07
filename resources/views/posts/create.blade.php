@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="caption">Post Caption</label>
                                <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption">{{ old('caption') }}</textarea>
                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Post Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add New Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
