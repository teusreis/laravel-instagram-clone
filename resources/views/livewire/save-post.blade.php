<div>
    <form wire:submit.prevent="submit">

        @if (auth()->user()->hasSaved($post))
            <button type="submit" class="bg-white border-0">
                <i class="fas fa-bookmark text-dark"></i>
            </button>
        @else
            <button type="submit" class="bg-white border-0">
                <i class="fas fa-bookmark text-secondary"></i>
            </button>
        @endif

    </form>
</div>
