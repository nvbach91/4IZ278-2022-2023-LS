@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>
            Galaxies
        </h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">

        <div class="list-group">
            @if ($galaxies->count() > 0)
                @foreach ($galaxies as $galaxy)
                    <a class="list-group-item list-group-item-action" href="{{ route('galaxies.show', $galaxy->id) }}">
                        <div class="d-flex align-items-start">
                            <img src="{{ $galaxy->image_url }}" class="me-3 rounded shadow" alt="Placeholder image" width="50"
                                height="50" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';">
                            <div class="flex-grow-1 align-middle">
                                <h5 class="align-middle">{{ $galaxy->name }}</h5>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                Nenalezena žádná galaxie :(
            @endif

        </div>
        <hr>
        <a class="btn btn-light" href="{{ route('galaxies.create') }}">Add Galaxy</a>
    </div>
@endsection
