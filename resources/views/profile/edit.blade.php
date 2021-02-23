@extends('layouts.app')

@section('content')

<div class="container">

    <form action="{{ route("profile.update", auth()->user()->username) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("put")

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="photo">Avatar</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    @error('photo')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old("name") ?? $user->name }}">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ old("username") ?? $user->username }}">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old("description") ?? $user->description }}</textarea>
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary ml-3">Update</button>
                                <a href="{{ route("profile.show", auth()->user()->username) }}" class="btn btn-secondary ml-3">Cancel</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
</div>

@endsection
