@extends('layout')

@section('content')
	<div class="container">
		<h1>Detaily úkolu</h1>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">{{ $task->name }}</h5>
				<p class="card-text">{{ $task->description }}</p>
				<a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Upravit</a>
				<form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Odstanit</button>
				</form>
                
			</div>
		</div>
	</div>
@endsection