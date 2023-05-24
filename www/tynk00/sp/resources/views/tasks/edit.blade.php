@extends('layout')

@section('content')
	<div class="container">
		<h1>Upravit úkol</h1>
		<form action="{{ route('tasks.update', $task->id) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="name">Název</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
			</div>
			<div class="form-group">
				<label for="description">Popis</label>
				<textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
			</div>
			<input type="hidden" id="user_id" name="user_id" value="{{ $task->user_id }}">
			<button type="submit" class="btn btn-primary">Uložit změny</button>
		</form>
	</div>
@endsection