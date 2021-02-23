<div>
    <div class="row ">
        <div class="col-12 d-flex justify-content-between py-3">
            @livewire('like-post', ['post' => $post])

            @livewire('save-post', ['post' => $post])
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-muted">
                <a href="{{ route("profile.show", $post->user->username) }}"
                    class="font-weight-bold text-dark text-decoration-none">
                    {{ $post->user->username }}
                </a>
                {{ $post->description }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            @if ($commentsNumber > 0)
                <a href="{{ route('post.show', $post->id) }}" class="text-muted font-weight-bold">
                    Se all the {{ $commentsNumber }} comments
                </a>
            @endif

        </div>
        <div class="col-12">
            @foreach ($comments as $comment)
                <p class="mb-1">
                    <a href="{{ route('profile.show', $comment->user->username) }}" class="text-dark font-weight-bold">
                        {{ $comment->user->username }}
                    </a>
                    {{ $comment->comment }}
                </p>
            @endforeach
        </div>
    </div>
    <div class="row">
        <form wire:submit.prevent="submit" class="w-100" class="">

            <div class="input-group">
                <input
                    type="text"
                    wire:model="comment"
                    name="comment"
                    class="form-control @error("comment") is-invalid @enderror"
                    placeholder="Comment...">

                <div class="input-group-append">
                    <button class="btn text-dark border-left-0 border-secondary" type="submit">Post</button>
                </div>
                @error('comment')
                    <p class="invalid-feedback px-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </form>
    </div>
</div>
