@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>
            Space stations
        </h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">

        <ul class="list-group">
            @if ($space_stations->count() > 0)
                @foreach ($space_stations as $space_station)
                    <a class="list-group-item list-group-item-action"
                        href="{{ route('space_stations.show', $space_station->id) }}">
                        <div class="d-flex align-items-start">
                            <img src="{{ $space_station->image_url }}" class="me-3 rounded shadow" alt="Placeholder image" width="50"
                                height="50"
                                onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">
                            <div class="flex-grow-1 align-middle">
                                <h5 class="align-middle">{{ $space_station->name }}</h5>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                Nenalezena žádná stanice :(
            @endif


        </ul>
        <hr>
        <a class="btn btn-light" href="{{ route('space_stations.create') }}">Add Space Station</a>
    </div>

    



@endsection
