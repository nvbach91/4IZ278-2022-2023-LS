@php
    $photoExists = $room->photo_file && Storage::disk('public')->exists('img/rooms/' . $room->photo_file);
@endphp

<x-layout>
    <main class="flex flex-col flex-1 m-auto mt-4 py-8 lg:w-[1024px]">
        <h2 class="text-3xl text-center mb-8">{{ $room->name }}</h2>
        <section class="flex flex-row gap-4">
            <div class="min-h-[360px] min-w-[50%] mr-4 {{ $photoExists ? 'bg-cover' : 'bg-gray-600' }}"
                style="@if ($photoExists) {{ 'background-image: url(\'' . asset('storage/img/rooms/' . $room->photo_file) . '\')' }} @endif">
            </div>
            <div class="ml-[-6px]">
                <p class="mb-8">{{ $room->description }}</p>
                <div class="grid grid-cols-2">
                    <div class="flex flex-col justify-between">
                        <div>
                            <p>Room size: {{ $room->size }} m&sup2;</p>
                            <p>Hourly price rate: <strong>{{ $room->price }} &#163;</strong></p>
                        </div>
                        <a class="inline w-fit px-4 py-2 bg-gray-200 hover:underline"
                            href="{{ $room->type === 'studio' ? url('/studios') : url('/rooms') }}">Back to listings</a>
                    </div>
                    <div>
                        <h3 class="font-semibold">Location</h3>
                        <p>{{ $room->city }}</p>
                        <p>{{ $room->street }}</p>
                        <p>{{ $room->zipcode }}</p>
                        <p>{{ $room->country }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-16">
            <h2 class="text-3xl text-center mt-4 mb-8">Booking</h2>
            @auth
                <p class="text-center">Work in progress...</p>
            @else
                <p class="text-center">You need to be <a class="text-blue-700" href="{{ url('/login') }}">logged in</a> in order to book sessions.</p>
            @endauth
        </section>
    </main>
</x-layout>
