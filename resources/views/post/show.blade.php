@extends('layouts.app')

@section('content')

<div class="post-container">
    <div class="row mt-3 justify-content-around">

        <div class="col-12 p-0">
            <div class="row">
                <div class="col-12 col-md-8 p-0 pr-md-0">
                    <img src="{{ $post->photo }}" class="w-100" width="" alt="">
                </div>
                <div class="col-md-4 d-md-flex flex-column d-none border">
                    <div class="row border-bottom justify-content-between">
                        <div class="user">
                            <img loading="lazy" src="{{ $post->user->photo }}" alt="" width="40" class="rounded-circle  m-2"><span>{{ $post->user->username }}</span>
                        </div>

                        @can('update', $post)

                            <div class="dropdown">
                                <i class="fas fa-ellipsis-v mr-3 mt-3" data-toggle="dropdown" id="postOptions" aria-haspopup="true" aria-expanded="false"></i>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="postOptions">
                                    <a class="d-block p-2 text-dark text-weight-bold" href="{{ route('post.edit', $post->id) }}">Update</a>
                                    <form action="{{ route('post.delete', $post->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="d-block p-2 text-decoration border-0" value="Delete">
                                    </form>
                                </div>

                            </div>
                        @endcan
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('profile.show', $post->user->username) }}" class="text-dark font-weight-bold">
                                {{ $post->user->username }}
                             </a>
                            {{ $post->description }}
                        </div>
                    </div>
                    <div class="row h-100">
                        @livewire('comment-post', ['post' => $post], key($post->id))
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
