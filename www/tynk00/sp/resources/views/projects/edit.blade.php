@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Edit Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.update', $project->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input type="hidden" id="user_id" name="user_id" value="{{ $project->user_id }}">
                            <button type="submit" class="btn btn-primary">{{ __('Update Project') }}</button>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
