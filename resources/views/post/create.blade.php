@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route("post.store") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control @error("photo") is-invalid @enderror" value="{{ old("photo") }}">
                    @error('photo')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control @error("description") is-invalid @enderror " cols="30" rows="10">{{ old("description") }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary ml-3">Post</button>
                        <a href="{{ route("profile.show", auth()->user()->username) }}" class="btn btn-light ml-3">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
