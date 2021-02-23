@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route("post.update", $post->id) }}" method="post">
        <div class="row">
            @csrf
            @method('patch')

            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-12">
                        <h3>Image</h3>
                    </div>
                    <div class="col-12">
                        <img src="{{ $post->photo }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10">{{ old("description") ?? $post->description }}</textarea>
                </div>
                <x-btn-submit></x-btn-submit>
            </div>

        </div>

    </form>
</div>
@endsection
