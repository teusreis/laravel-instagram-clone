@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="col-8 offset-2">

                <div class="row mb-2">
                    <div class="col-12">
                        <h3 class="h6">Suggestions</h3>
                    </div>
                </div>


                @foreach ($users as $user)
                    <div class="row">

                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <div class="">
                                <img src="{{ $user->photo }}"
                                width="45"
                                class="rounded-circle mr-3"
                                alt="">

                                <a href="{{ route('profile.show', $user->username) }}" class="text-dark text-decoration-none">
                                    {{ $user->username }}
                                </a>
                            </div>

                            <div class="">

                                <form action="{{ route('follow', $user->username) }}" method="post" class="d-block ml-auto">
                                    @csrf
                                    <button type="submit" class="border-0 btn btn-sm btn-primary font-weight-bold" href="#">Follow</button>
                                </form>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>


        </div>

    </div>
@endsection
