<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <!-- Reality Check Logo -->
    <a class="navbar-brand" href="{{ url('/') }}">Reality Check</a>

    <!-- Navbar toggler button for smaller screens -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile.interests') }}">My Interesting Properties</a>
        </li>
        @endif
        <!-- Authentication Links -->
        @if (Route::has('login'))
        @auth
        <!-- Links for authenticated users -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
        @else
        <!-- Links for guests -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Sign in</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Sign up</a>
        </li>
        @endif
        @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>