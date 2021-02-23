@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row my-3 border-bottom py-2">
        <div class="col-md-4">
            <img loading="lazy" src="{{ $user->photo }}" alt="" class="img-fluid mx-auto d-block rounded-circle  mr-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <h3 class="d-inline mr-2 font-weight-normal">
                        {{ $user->username }}
                    </h3>
                    @auth

                        @can('update', $user)
                            <a href="{{ route("profile.edit", auth()->user()->username) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="{{ route("post.create") }}" class="btn btn-sm btn-outline-secondary">New Post</a>
                        @else
                            @if (auth()->user()->isFollowing($user))
                                <form action="{{ route('unfollow', $user->username) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-primary" href="#">unFollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow', $user->username) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary" href="#">Follow</button>
                                </form>
                            @endif
                        @endcan

                    @endauth
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex py-3">
                    <div class="mr-5">
                        {{ $user->postsNumber() }} Posts
                    </div>

                    <div class="mr-5">
                        {{ $user->followerNumber() }} Followers
                    </div>

                    <div class="mr-5">
                        {{ $user->followsNumber() }} Following
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4 class="font-weight-bold h5">
                        {{ $user->name }}
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-muted">
                        {{ $user->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="">

        @livewire('user-posts', ['userId' => $user->id])

    </div>

</div>

@endsection
