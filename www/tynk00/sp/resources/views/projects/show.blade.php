@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ $project->name }}</div>

                    <div class="card-body">
                        <p>{{ $project->description }}</p>

                        <h5>{{ __('Úkoly') }}</h5>
                        @if ($project->tasks->count() > 0)
                            <ul>
                                @foreach ($project->tasks as $task)
                                    <li>{{ $task->description }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('Žádné úkoly nenalezeny.') }}</p>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>

                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                            </form>

                            <a href="{{ route('projects') }}" class="btn btn-secondary">{{ __('Back to Projects') }}</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
