<div>
    <div class="row justify-content-between  border-bottom">
        <div>
            <img loading="lazy" src="{{ $post->user->photo }}" alt="" width="40" class="rounded-circle  m-2"><span>{{ $post->user->username }}</span>
        </div>
        @can('update', $post)

            <div class="dropdown">
                <i class="fas fa-ellipsis-v mr-3 mt-3" data-toggle="dropdown" id="postOptions" aria-haspopup="true" aria-expanded="false"></i>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="postOptions">
                    <a class="d-block p-2 text-dark text-weight-bold" href="{{ route('post.edit', $post->id) }}">Update</a>
                    <form action="{{ route('post.delete', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="d-block p-2 text-decoration border-0" value="Delete">
                    </form>
                </div>

            </div>
        @endcan
    </div>
    <div class="row flex-column border-bottom h-100">
        <div class="">
            {{ $post->description }}
        </div>
        <div class="">
            comments goes here..
        </div>
    </div>

    <div class="row">
        <div class=" d-flex justify-content-between py-3">
            <div class="action">
                @if ($post->isLikedBy(auth()->user()))
                    <form action="{{ route('post.unlike', $post->id) }}" method="post" class="d-inline mx-2 like">
                        @csrf
                        @method('delete')

                        <button type="submit" class="border-0 p-0 bg-white text-danger">
                            <i class="fas fa-heart"></i> {{ $post->likesCount() }}
                        </button>
                    </form>
                @else
                    <form action="{{ route('post.like', $post->id) }}" method="post" class="d-inline mx-2 like">
                        @csrf
                        <button type="submit" class="border-0 p-0 bg-white">
                            <i class="fas fa-heart text-secondary"></i>
                        </button>
                    </form>
                @endif

                <div class="d-inline save">
                    <i class="far fa-commen t"></i>
                </div>
            </div>

            <div class="save">
                <i class="far fa-save"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-group">
            <input type="text" class="form-control boder-bottom-0" placeholder="Comment...">
            <div class="input-group-append">
                <button class="btn text-dark border-left-0 border-secondary" type="button" id="button-addon2">Submit</button>
            </div>
        </div>
    </div>
</div>
