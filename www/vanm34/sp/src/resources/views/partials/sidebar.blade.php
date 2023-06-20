<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Reality Check</h3>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="{{ url('/') }}">Home</a>
        </li>
        <li>
            <a href="{{ url('/properties') }}">View Properties</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">Contact</a>
        </li>

        <!-- Show this list item only if the user is logged in and has a role of 1 -->
        @if(Auth::check() && Auth::user()->role == 1)
        <li>
            <a href="{{ url('/propertyEditor') }}">Property Editor</a>
        </li>
        @endif
    </ul>
</nav>