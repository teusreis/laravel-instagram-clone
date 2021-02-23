<div class="">
    <form wire:submit.prevent="submit" class="d-inline mx-2 like">

        @if ($post->isLikedBy(auth()->user()))
            <button type="submit" class="border-0 p-0 bg-white text-danger">
                <i class="fas fa-heart "></i> {{ $post->likesCount() }}
            </button>
        @else
            <button type="submit" class="border-0 p-0 bg-white text-secondary">
                <i class="fas fa-heart"></i> {{ $post->likesCount() }}
            </button>
        @endif

    </form>
</div>
