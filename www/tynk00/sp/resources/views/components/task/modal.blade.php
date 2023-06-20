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
                        <label for="due">Datum</label>
                        <input type="date" class="form-control" id="due" name="due">
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="project_id" class="form-label">City</label>
                            <select class="form-select form-select-lg" name="project_id" id="project_id">
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
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

<script>
    function loadModal() {
        $.get('{{ route('task.modal') }}', function(response) {
            $('#modal-container').html(response);
            $('#modal').modal('show');
        });
    }
</script>
