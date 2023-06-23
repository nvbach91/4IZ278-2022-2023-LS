@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h2 class="text-light m-0">{{ __('Úprava poznámky') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notes.update', $note->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">{{ __('Název') }}</label>
                                <input id="title" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="title"
                                    value="{{ old('title', $note->title) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="body">{{ __('Text') }}</label>
                                <textarea id="body" class="form-control @error('body') is-invalid @enderror" rows="7" name="body">{{ old('body', $note->body) }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="square-radio px-3">
                                    <div class="row">
                                        @foreach ($colors as $color)
                                            <div class="col-1">
                                                <input class="form-check-input" type="radio" name="color"
                                                    value="{{ $color->HEX }}"
                                                    {{ $note->color == $color->HEX ? 'checked' : '' }}
                                                    style="background-color: #{{ $color->HEX }}" required>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="project_id" class="form-label">Projekt</label>
                                <select class="form-control" name="project_id" id="project_id">
                                    <option value="">Bez projektu</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" {{ $note->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                            <button type="submit" class="btn btn-primary">{{ __('Uložit') }}</button>
                            <a href="{{ route('return') }}" class="btn btn-secondary">{{ __('Zrušit') }}</a>

                            
                        </form>
                        <hr>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Odstranit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeColor(color) {
            inp = document.getElementById("colorOfProject");
            inp.value = color;
        }
    </script>
@endsection
