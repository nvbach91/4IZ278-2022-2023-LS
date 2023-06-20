<nav class="navbar shadow navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="/">TaskShin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>
                    Přehled</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects') }}"><i class="fa fa-flask" aria-hidden="true"></i>
                    Projekty</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tasks') }}"><i class="fa fa-tasks" aria-hidden="true"></i> Úkoly</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notes') }}"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                    Poznámky</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tags') }}"><i class="fa fa-tags" aria-hidden="true"></i> Tagy</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle bg-dark rounded shadow" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar"  onerror="this.src='{{ asset('images/avatar.png') }}'">
                        </div>
                        <span class="username ms-1">{{ Auth::user()->name }}</span>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"  aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('user.settings') }}">Nastavení</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Odhlásit
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
