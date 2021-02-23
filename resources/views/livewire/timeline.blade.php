<div class="col-md-8 p-0 px-md-3">

    @forelse ($posts  as $post)
        <div class="card mt-3">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card-header bg-white px-0 d-flex justify-content-between">
                    <div>
                        <a href="{{ route("profile.show", $post->user->username) }}" class="text-decoration-none">
                            <img loading="lazy"
                                src="{{ $post->user->photo }}"
                                width="32" alt="profile photo"
                                class="rounded-circle  mr-2">
                        </a>

                        <a href="{{ route("profile.show", $post->user->username) }}" class="text-dark">
                            {{ $post->user->name }}
                        </a>
                    </div>

                    @can('update', $post)

                        <div class="dropdown">
                            <i class="fas fa-ellipsis-v mr-3 mt-3"
                                data-toggle="dropdown"
                                id="postOptions"
                                aria-haspopup="true"
                                aria-expanded="false"
                                role="button">
                            </i>

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

                <div class="row">
                    <img loading="lazy" src="{{ $post->photo }}" class="img-fluid w-100">
                </div>

                @livewire('timeline-comment', ['post' => $post], key($post->id))
            </div>
        </div>

    @empty

        <div class="col-12 text-center">
            <p>There is no post!</p>
        </div>
    @endforelse

    @section('script')

        <script>

            window.onscroll = (event) => {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1) {
                    Livewire.emit('renderMore');
                }
            };

        </script>

    @endsection

</div>
