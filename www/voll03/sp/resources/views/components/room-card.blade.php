@props(['room'])

@php
    $photoExists = $room->photo_file && Storage::disk('public')->exists('img/rooms/' . $room->photo_file);
@endphp

<a href="{{ url('/rooms/' . $room->id) }}">
    <span class="flex flex-col items-center mb-8 md:mb-0">
        <div class="min-h-[200px] w-full {{ $photoExists ? 'bg-cover' : 'bg-gray-600' }}"
            style="@if ($photoExists) {{ 'background-image: url(\'' . asset('storage/img/rooms/' . $room->photo_file) . '\')' }} @endif">
        </div>
        <h3 class="text-center mt-4">{{ $room->name }}</h3>
    </span>
</a>
