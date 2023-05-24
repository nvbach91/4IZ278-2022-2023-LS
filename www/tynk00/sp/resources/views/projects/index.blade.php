@extends('layout')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('projects.create') }}" class="btn btn-primary">Přidat projekt</a>
            </div>
        </div>
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Zobrazit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection