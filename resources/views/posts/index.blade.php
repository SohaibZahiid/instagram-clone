@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="row mt-4 ">
                <div class="col-12 col-sm-10 col-md-6 offset-sm-1 offset-md-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <img src="/storage/{{ $post->user->profile->image }}" alt="profile" class="rounded-circle"
                            style="max-width: 50px">
                        <p style="margin: 0"><span class="fw-bold"><a href="/profile/{{ $post->user->id }}" class="link-dark"
                                    style="text-decoration: none;">{{ $post->user->username }}</a>
                    </div>
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="/storage/{{ $post->image }}" alt="post" class="img-fluid rounded">
                    </a>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-12 col-sm-10 col-md-6 offset-sm-1 offset-md-3">
                    <p><span class="fw-bold"><a href="/profile/{{ $post->user->id }}" class="link-dark"
                                style="text-decoration: none;">{{ $post->user->username }}</a>
                        </span>{{ $post->caption }}</p>
                    <hr>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
