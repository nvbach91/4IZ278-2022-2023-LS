<x-layout>
      <x-slot:title>
        {{ $space_station->name }}
    </x-slot>
        <table>
            <tr>
                <td>Name</td>
                <td>{{ $space_station->name }}</td>
            </tr>
            <tr>
                <td>Location</td>
                <td>({{ $space_station->x }}, {{ $space_station->y }}, {{ $space_station->z }})</td>
            </tr>
            <tr>
                <td>Image</td>
                <td><img class="h-20" src="{{ $space_station->image_url }}"/></td>
            </tr>
            </table>
        </div>
 
</x-layout>