@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h2 class="mb-0">
                            {{ __('Nový projekt') }}
                        </h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{ __('Název') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Popis') }}</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                @error('description')
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
                                                    {{ $color->HEX == 'FFFFFF' ? 'checked' : '' }}
                                                    style="background-color: #{{ $color->HEX }}" required>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>



                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                            <button type="submit" class="btn btn-primary">{{ __('Uložit') }}</button>
                            <a href="{{ route('projects') }}" class="btn btn-secondary">{{ __('Zrušit') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeColor(color, ) {
            inp = document.getElementById("colorOfProject");
            inp.value = color;
        }
    </script>
@endsection
