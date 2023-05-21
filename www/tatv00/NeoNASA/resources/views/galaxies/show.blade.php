@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>{{ $galaxy->name }}</h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div>
                    <p class="bg-light text-dark rounded p-2">Size: {{ $galaxy->size }}</p>
                    <p class="bg-light text-dark rounded p-2">
                        @if (is_null($galaxy->description))
                            Bez popisku
                        @else
                            {{ $galaxy->description }}
                        @endif

                    </p>
                </div>
                <img class="mt-2 rounded w-100 shadow" src="{{ $galaxy->image_url }}" alt="{{ $galaxy->name }}"
                    onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">


            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <h3 class="mb-3">Space Stations ({{ $galaxy->spaceStations->count() }}):</h3>
                <ul class="list-group">
                    @foreach ($galaxy->spaceStations as $space_station)
                        <a href="{{ route('space_stations.show', $space_station->id) }}"
                            class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-start">
                                <img src="{{ $space_station->image_url }}" class="me-3 rounded shadow"
                                    alt="Placeholder image" width="50" height="50"
                                    onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">
                                <div class="flex-grow-1">
                                    <h5>{{ $space_station->name }}</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="btn-group dropup">
            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('galaxies.edit', $galaxy->id) }}"><i class="fa fa-pencil"
                            aria-hidden="true"></i>
                        Edit</a></li>
                @if ($galaxy->spaceStations->count() > 0)
                    <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#clearModal">
                            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                            Clear stations
                        </button></li>
                @endif




                @if ($galaxy->spaceStations->count() > 0)
                    <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                class="fa fa-trash" aria-hidden="true"></i>
                            Delete</button></li>
                @else
                    <form action="{{ route('galaxies.destroy', $galaxy->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <li><button class="dropdown-item" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>
                                Delete</button></li>
                    </form>
                @endif









            </ul>
        </div>

        @if ($galaxy->spaceStations->count() > 0)
            <form action="{{ route('galaxies.destroy', $galaxy->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">Varování</h1>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                Všechny stanice uvnitř této galaxie budou ztraceny! <br>
                                Tato galaxie obsahuje následující počet vesmírných stanic:
                                {{ $galaxy->spaceStations->count() }}<br>
                                Přejete si i tak odstranit tuto galaxii?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-space" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('galaxies.clear', $galaxy->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="clearModal" tabindex="1" aria-labelledby="clearModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="clearModalLabel">Varování</h1>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                Touto akcí budou všechny stanice uvnitř této galaxie budou smazány! <br>
                                Přejete si provést tuto akci?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-space" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif




    </div>
@endsection
