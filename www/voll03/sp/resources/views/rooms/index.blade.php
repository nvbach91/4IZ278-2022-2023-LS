<x-layout>
    <main class="m-auto mt-4 p-8 lg:w-[1088px] w-full">
        <h2 class="text-center text-3xl mb-12">{{ $heading }}</h2>
        @foreach ($allRooms as $city => $rooms)
            <h2 class="text-center text-2xl mt-4 mb-8">{{ $city }}</h2>
            <section class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 justify-center md:gap-8 mb-12">
                @foreach ($rooms as $room)
                    <x-room-card :room="$room" />
                @endforeach
            </section>
            @if (!$loop->last)
                <hr />
            @endif
        @endforeach

    </main>
</x-layout>
