<x-layout>
    <x-slot:title>
        Space Stations
    </x-slot>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
            <thead>
                <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Image</th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                    <span class="sr-only">Detail</span>
                </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($space_stations as $ss)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $ss->name }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">({{ $ss->x }}, {{ $ss->y }}, {{ $ss->z }})</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><img class="h-8" src="{{ $ss->image_url }}"/></td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <a href="/space-station/{{ $ss->id }}" class="text-indigo-600 hover:text-indigo-900">Detail<span class="sr-only">, {{ $ss->name }}</span></a>
                        </td>
                    </tr>
                @endforeach
                <!-- More people... -->
            </tbody>
            </table>
        </div>
        </div>
    </div>
</x-layout>