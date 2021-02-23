<nav class="navbar navbar-expand navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{ route("home")  }}">InstaClone</a>

        <div class="">
            @livewire('search-user')
        </div>

        <div class="navbar-nav font-weight-bolder">
            @guest

                <div class="nav-link">
                    <a href="{{ route("login") }}" class="btn btn-primary btn-sm">Login</a>
                </div>

                <div class="nav-link">
                    <a href="{{ route("register") }}" class="btn btn-secondary btn-sm">Register</a>
                </div>

            @else

                <div class="nav-link">
                    <a href="{{ route("home") }}" class="text-secondary">
                        <i class="fas fa-home"></i>
                    </a>
                </div>

                <div class="nav-link dropdown p-0">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->photo }}" alt="" class="img-fluid rounded-circle" width="25">
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item pl-2" href="{{ route("profile.show", auth()->user()->username) }}">
                            <i class="fas fa-user mr-1"></i>
                            Profile
                        </a>
                        <a class="dropdown-item pl-2" href="{{ route("save.index") }}">
                            <i class="far fa-save mr-1"></i>
                            Saved
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item pl-2">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            @endguest

        </div>
    </div>
</nav>
