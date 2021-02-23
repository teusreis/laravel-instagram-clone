<div>
    <div class="row">
        <div class="col-12 border-bottom mb-3 px-0">
            <p class="text-muted ">Only you can see the posts you've saved!</p>
        </div>
    </div>

    <div class="row">
        @forelse($saved as $post)
            <div class="col-12 col-md-4 mb-4 px-0 px-md-3">
                <a href="{{ route("post.show", $post->post->id) }}">
                    <img loading="lazy" src="{{ $post->post->photo }}" class="img-fluid w-100">
                </a>
            </div>
        @empty

            <div class="col-12">
                <p class="text-center">
                    You do not have any post saved!
                </p>
            </div>

        @endforelse
    </div>

    @if (count($saved) !== $total)

        <div class="row">
            <div class="col-12 text-center py-2">
                <button class="text-muted font-weight-bold border-0 bg-white"
                    wire:click="loadMore">
                    Load More
                </button>
            </div>
        </div>

    @else

        <div class="row">
            <div class="col-12 text-center py-2">
                <button class="text-muted font-weight-bold border-0 bg-white" wire:click="">
                    There is no more posts!
                </button>
            </div>
        </div>

    @endif
</div>
