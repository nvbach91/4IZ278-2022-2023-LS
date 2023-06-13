<div class="flex md:flex-row flex-col md:gap-8 gap-4">
    @auth
    <div class="flex md:flex-row flex-col gap-4">
        <a href="{{ url('/bookings') }}">Bookings</a>
        <a href="{{ url('/user') }}">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @else
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
    @endauth
</div>
