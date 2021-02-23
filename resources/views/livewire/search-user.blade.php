<div class="navbar-nav d-none d-md-block position-relative">

    <input
    wire:model="query"
    type="text"
    class="form-control form-control-sm rounded"
    placeholder="Search Users"
    style="z-index: 5;">

    <div wire:loading.delay class="text-muted position-absolute mt-1">
        Searching...
    </div>

    @if (!empty($query))

        <div class="hack fixed-top w-100"
            wire:click="resetQuery"
            style="z-index: 1; height: 100vh; "
            >

        </div>

        <div class="position-absolute mt-1 border" style="z-index: 5; min-width: calc(100% + 40px); left: -20px">
            @forelse ($users as $i => $user)
                <div class="bg-white p-2">
                    <div class="row justify-content-center @if(!$loop->last) border-bottom @endif">
                        <div class="col-2 p-0">
                            <a href="{{ route("profile.show", $user["username"]) }}">
                                <img
                                    src="{{ $user["photo"] }}"
                                    alt="profile-img"
                                    class="img-fluid rounded-circle"
                                    width="40"
                                    >
                            </a>
                        </div>
                        <div class="col-8">
                            <a href="{{ route("profile.show", $user["username"]) }}"
                                class="text-dark text-weight-bold">
                                {{ $user["username"] }}
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="text-muted font-weight-bold text-center">No user found</div>
            @endforelse

        </div>

    @endif
</div>
