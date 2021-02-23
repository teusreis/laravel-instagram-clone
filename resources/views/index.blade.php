@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        @livewire('timeline')

        <div class="col-md-4 d-none d-md-block">
            <div class="row py-3">
                <div class="col-3">
                    <img src="{{ auth()->user()->photo }}"
                        width="50"
                        alt="image profile"
                        class="rounded-circle d-block mx-auto">
                </div>
                <div class="col">
                    <p class="m-0 font-weight-bold"> {{ auth()->user()->username }} </p>
                    <p class="m-0 text-muted"> {{ auth()->user()->name }} </p>
                </div>
            </div>

            <div class="col-12 px-0 py-2 d-flex justify-content-between">
                <p class="text-muted font-weight-bold ">
                    Some suggestion for you!
                </p>
                <a href="{{ route('explore.index') }}" class=" text-dark">
                    See all
                </a>
            </div>

            <div class="row">
                @foreach (auth()->user()->explore(limit: 5) as $user)

                    <div class="col-12 mb-3 d-flex justify-content-between">
                        <div class="">
                            <img src="{{ $user->photo }}"
                            width="32"
                            class="rounded-circle mr-3"
                            alt="">

                            <a href="{{ route('profile.show', $user->username) }}" class="text-dark text-decoration-none">
                                {{ $user->username }}
                            </a>
                        </div>
                        <div class="">

                            <form action="{{ route('follow', $user->username) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="border-0 bg-white text-primary" href="#">Follow</button>
                            </form>

                        </div>

                    </div>

                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
