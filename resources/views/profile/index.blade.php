@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{ $user->profile->profileImage() }}" alt="profile" class="img-fluid rounded-circle"
                    style="width: 150px; object-fit:cover;">
            </div>
            <div class="col-9 p-5 d-flex flex-column gap-4">
                <div class="d-flex justify-content-between align-items">
                    <div class="d-flex gap-3 align-items-center">
                        <h4 style="margin: 0;">{{ $user->username }}</h4>
                        @if (auth()->user()->id !== $user->id)
                            <button class="btn btn-light btn-sm follow-btn" data-user-id="{{ $user->id }}"
                                data-follows="{{ $follows }}">{{ $follows ? 'Unfollow' : 'Follow' }}</button>
                        @endif
                    </div>
                    <div class="d-flex gap-4">
                        @can('update', $user->profile)
                            <a href="{{ route('profile.edit', $user->id) }}" class="text-primary"
                                style="text-decoration: none;">Edit Profile</a>
                            <a href="{{ route('post.create') }}" class="text-primary" style="text-decoration: none;">New
                                Post</a>
                        @endcan
                    </div>
                </div>
                <div class="d-flex gap-5">
                    <div><strong>{{ $postCount }}</strong> posts</div>
                    <div><strong class="follower-count">{{ $followerCount }}</strong> followers</div>
                    <div><strong class="following-count">{{ $followingCount }}</strong> following</div>
                </div>
                <div>
                    <h6><strong>{{ $user->name }}</strong></h6>
                    <p>
                        {{ $user->profile->description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach ($user->posts as $post)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pb-4">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="/storage/{{ $post->image }}" alt="post" class="img-fluid text-center"
                                style="height: 250px; width: 250px; object-fit:cover;">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {

            const followBtn = document.querySelector('.follow-btn');
            const uid = followBtn?.getAttribute('data-user-id');
            let follows = followBtn?.getAttribute('data-follows');
            let followers = document.querySelector('.follower-count');
            let following = document.querySelector('.following-count');



            followBtn?.addEventListener('click', () => {

                axios.post(`/follow/${uid}`)
                    .then(res => {
                        // CHANGE FOLLOW BUTTON TO UNFOLLOW WIHTOUT REFRESH
                        follows = !follows
                        const buttonText = follows ? 'Unfollow' : 'Follow';
                        followBtn.innerText = buttonText;

                        // CHANGE FOLLOWERS COUNT
                        // const followerCount = {{ $user->profile->followers->count() }}
                        // followers.innerText = `${followerCount} `
                        followers.innerText = res.data.followerCount;

                        // // CHANGE FOLLOWING COUNT
                        // following.innerText = res.data.followingCount;

                    }).catch(err => {
                        if (err.response.status === 401) {
                            window.location = "{{ route('login') }}";
                        }
                    })
            })

        })
    </script>
@endsection
