<div class="">

    <div class="row">
        @forelse($posts as $post)
            <div class="col-12 col-md-4 mb-4 px-0 px-md-3">
                <a href="{{ route("post.show", $post->id) }}">
                    <img loading="lazy" src="{{ $post->photo }}" class="img-fluid w-100">
                </a>
            </div>
        @empty

            <div class="col-12">
                <p class="text-center">
                    There is no post to show!
                </p>
            </div>

        @endforelse
    </div>

    @if (count($posts) != $total)

        <div class="row">
            <div class="col-12 text-center py-2">
                <p class="text-muted font-weight-bold"
                    wire:click="loadMore">
                    Load More
                </p>
            </div>
        </div>

    @endif

</div>


