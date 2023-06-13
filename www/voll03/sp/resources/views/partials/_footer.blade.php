<footer class="bg-gray-900">
    <div class="lg:w-[1024px] py-8 m-auto text-white grid grid-cols-2">
        <div>
            <h2 class="mb-4">Rooms in cities:</h2>
            @foreach(\App\Models\Address::all() as $address)
                <p>{{ $address->city }}</p>
            @endforeach
        </div>
        <div class="text-right">
            <nav>
                <ul class="flex flex-col">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/rooms') }}">Rehearsal rooms</a></li>
                    <li><a href="{{ url('/studios') }}">Studio rooms</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="text-center text-sm text-white mb-8">Copyright &copy; 2023, SoundChecker</div>
</footer>