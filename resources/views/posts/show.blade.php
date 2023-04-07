@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" alt="post" class="img-fluid rounded">
            </div>
            <div class="col-4">
                <div class="d-flex gap-2 align-items-center">
                    <div>
                        <img src="{{ $post->user->profile->profileImage() }}" alt="profile" class="rounded-circle w-100"
                            style="max-width: 50px">
                    </div>
                    <span class="fw-bold"><a href="/profile/{{ $post->user->id }}" class="link-dark"
                            style="text-decoration: none;">{{ $post->user->username }}</a>
                    </span>
                    @if (auth()->user()->id !== $post->user_id)
                        <span>&#8226;</span>
                        <a href="#" class="fw-bold follow-btn" data-follows="{{ $follows }}"
                            data-user-id="{{ $post->user->id }}"
                            style="text-decoration: none;">{{ $follows ? 'Unfollow' : 'Follow' }}</a>
                    @endif
                </div>

                <hr>

                <p><span class="fw-bold"><a href="/profile/{{ $post->user->id }}" class="link-dark"
                            style="text-decoration: none;">{{ $post->user->username }}</a>
                    </span>{{ $post->caption }}</p>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {

            const followBtn = document.querySelector('.follow-btn');
            const uid = followBtn.getAttribute('data-user-id');
            let follows = followBtn.getAttribute('data-follows');


            followBtn.addEventListener('click', () => {

                axios.post(`/follow/${uid}`)
                    .then(res => {
                        // CHANGE FOLLOW BUTTON TO UNFOLLOW WIHTOUT REFRESH
                        follows = !follows
                        const buttonText = follows ? 'Unfollow' : 'Follow';
                        followBtn.innerText = buttonText;

                    }).catch(err => {
                        console.log(err);
                        if (err.response.status === 401) {
                            window.location = "{{ route('login') }}";
                        }
                    })
            })

        })
    </script>
@endsection
