@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>{{ $space_station->name }}</h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div>
                    <p class="bg-light text-dark rounded p-2">3D GPS Coordinates: {{ $space_station->gps_3d_coordinates }}
                    </p>
                    <p class="bg-light text-dark rounded p-2">
                        @if (is_null($space_station->description))
                            Bez popisku
                        @else
                            {{ $space_station->description }}
                        @endif
                    </p>
                </div>
                <img class="mt-2 rounded w-100 shadow" src="{{ $space_station->image_url }}" alt="{{ $space_station->name }}"
                    onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">


            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <h3 class="mb-3">Galaxy:</h3>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                        href="{{ route('galaxies.show', $space_station->galaxy->id) }}">
                        <div class="d-flex align-items-start">
                            <img src="{{ $space_station->galaxy->image_url }}" class="me-3 rounded shadow"
                                alt="Placeholder image" width="50" height="50"
                                onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">
                            <div class="flex-grow-1 align-middle">
                                <h5 class="align-middle">{{ $space_station->galaxy->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>


        <div class="btn-group dropup">
            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('space_stations.edit', $space_station->id) }}"><i
                            class="fa fa-pencil" aria-hidden="true"></i>
                        Edit</a></li>
                <form action="{{ route('space_stations.copy', $space_station->id) }}" method="post">
                    @csrf
                    <li><button class="dropdown-item" type="submit"><i class="fa fa-clone" aria-hidden="true"></i>
                            Copy</button></li>
                </form>
                <form action="{{ route('space_stations.destroy', $space_station->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <li><button class="dropdown-item" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>
                            Delete</button></li>
                </form>
            </ul>
        </div>




    </div>
@endsection
