
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height: 12vh">
    <div class="container">
        <a class="navbar-brand" style="color:salmon;" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                @if (url()->current() !== url('/'))
                <!-- hide login dropdown -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (url()->current() !== url('/'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link" data-toggle="dropdown">
                        <img class="auth-avatar" src={{asset(Auth::user()->profile->image->first()->path)}}>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href={{url(Auth::user()->profile->path())}} class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .auth-avatar {
        border-radius: 5rem;
        width: 3rem;
        height: 3rem;
        object-fit: cover;
        border-radius: 50%;
        transition: 200ms;
    }
    .auth-avatar:hover {
        box-shadow: 0 0 1px 0.3rem lightgrey;
    }
</style>
