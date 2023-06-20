@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h2 class="text-light m-0">Upravit úkol</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Název</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ $tag->name }}">
                    </div>
                    <div class="form-group">
                        <label for="color">Barva</label>
                        <input type="color" class="form-control" id="color" name="color" value="#{{ $tag->color }}">
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $tag->user_id }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $tag->id }}">
                    <button type="submit" class="btn btn-primary">Uložit změny</button>
                </form>
            </div>


        </div>

    </div>
@endsection
