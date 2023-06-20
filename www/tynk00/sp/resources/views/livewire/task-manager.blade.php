<div>

    <div class="p-2 shadow-lg rounded bg-dark mb-3">
        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addTaskModal">Nový úkol</a>
        <div class="float-right">
            <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off" wire:model="closedTasks">
            <label class="btn btn-outline-light" for="btn-check-outlined">Zobrazit dokončené úkoly</label><br>

        </div>
    </div>





    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th class="text-end text-nowrap" style="width: 50px;"></th>
                <th>Name</th>
                <th>Project</th>
                <th>Due Date</th>
                <th class="text-end text-nowrap" style="width: 50px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="{{ $task->completed ? 'completed' : '' }}">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="custom-control-input
                            name="completed" {{ $task->completed ? 'checked' : '' }}
                            id="task{{ $task->id }}Checkbox" wire:click="completeTask({{ $task->id }})">
                            <label class="custom-control-label" for="task{{ $task->id }}Checkbox"></label>
                        </div>


                    </td>
                    <td>{{ $task->name }}</td>
                    <td>
                        @if ($task->project != null)
                            {{ $task->project->name }}
                        @endif
                    </td>
                    <td>{{ $task->due }}</td>

                    <td class="text-end" style="width: 50px;">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link dropdown-toggle" type="button"
                                id="task{{ $task->id }}Actions" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="task{{ $task->id }}Actions">
                                <li><a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">Zobrazit</a>
                                </li>
                                <li><a class="dropdown-item" data-toggle="modal" data-target="#editTaskModal"
                                        wire:click="updateTask({{ $task->id }})">Upravit</a>
                                </li>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <li><button type="submit" class="dropdown-item"
                                            href="#">Odstranit</a></button>
                                </form>

                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>









    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel"
        aria-hidden="true">
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
                            <label for="name">Datum</label>
                            <input type="date" class="form-control" id="due" name="due">
                        </div>
                        <div class="form-group">
                            <label for="project_id" class="form-label">Projekt</label>
                            <select class="form-control" name="project_id" id="project_id">
                                <option value="">Bez projektu</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Popis</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        <button type="submit" class="btn btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Upravit úkol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Název</label>
                            <input type="text" class="form-control" id="name" name="name"
                                wire:model="name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Datum</label>
                            <input type="date" class="form-control" id="due" name="due"
                                wire:model="due">
                        </div>
                        <div class="form-group">
                            <label for="project_id" class="form-label">Projekt</label>
                            <select class="form-control" name="project_id" id="project_id" wire:model="project_id">
                                <option value="">Bez projektu</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Popis</label>
                            <textarea class="form-control" id="description" name="description" rows="3" wire:model="description"></textarea>
                        </div>
                        <input type="hidden" id="taskId" name="taskId" wire:model="taskId">
                        <button type="submit" class="btn btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
