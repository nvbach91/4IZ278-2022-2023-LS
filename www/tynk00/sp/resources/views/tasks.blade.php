@extends('layout')

@section('content')
    <!-- Task List Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1>Seznam úkolů</h1>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTaskModal">Přidat úkol</a>
        </div>
    </div>

    <!-- Task List -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Název</th>
                <th>Popis</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-primary">Zobrazit</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-secondary">Upravit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Odstranit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addTaskModalLabel">Přidat nový úkol</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('tasks.store') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">Název</label>
							<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="form-group">
							<label for="description">Popis</label>
							<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
						</div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
						<button type="submit" class="btn btn-primary">Uložit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
