<div class="col-12 d-flex flex-column justify-content-between">

    <div class="row h-100">
        <div class="col-12 comments-container overflow-auto">
            <div class="row">

                @foreach ($comments as $comment)
                    <div class="col-12">
                        <p class="mb-1">

                           <a href="{{ route('profile.show', $comment->user->username) }}" class="text-dark font-weight-bold">
                               {{ $comment->user->username }}
                            </a>
                            {{ $comment->comment }}
                        </p>
                    </div>
                @endforeach

                @unless (count($comments) == $total)
                    <div class="col-12 text-center">
                        <button wire:click="readMore" class="font-weight-bold text-muted border-0 bg-transparent">Read more</button>
                    </div>
                @endunless
            </div>
        </div>
    </div>

    <div class="row action mb-1">
        <div class="col-12">
            @if ($post->isLikedBy(auth()->user()))
                <form action="{{ route('post.unlike', $post->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')

                    <button type="submit" class="border-0 p-0 bg-white text-danger">
                        <i class="fas fa-heart"></i> {{ $post->likesCount() }}
                    </button>
                </form>
            @else
                <form action="{{ route('post.like', $post->id) }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="border-0 p-0 bg-white">
                        <i class="fas fa-heart text-secondary"></i>
                    </button>
                </form>
            @endif

            @if (auth()->user()->hasSaved($post))
                <form action="{{ route("save.delete", $post->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="bg-white border-0">
                        <i class="fas fa-bookmark text-dark"></i>
                    </button>
                </form>
            @else
                <form action="{{ route("save.store", $post->id) }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="bg-white border-0">
                        <i class="fas fa-bookmark text-secondary"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12 p-0">

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

</div>
