@extends('layout')

@section('content')
    <div class="card" style="background-color: #{{ $project->color }}88">
        <div class="card-header bg-dark">
            <h2 class="text-light m-0">
                {{ $project->name }}
            </h2>

        </div>
        <div class="bg-secondary p-2">
            <div>
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning me-2"><i
                        class="fa fa-pencil-square-o" aria-hidden="true"></i> Upravit</a>
                <button type="submit" class="btn btn-danger" data-toggle="modal"
                data-target="#deleteProjectModal"><i class="fa fa-trash" aria-hidden="true"></i>
                    Odstranit</button>
            </div>
        </div>
        <div class="card-body">

            <div class="pb-3">
                @foreach ($project->tags as $tag)
                    <a class="btn badge p-2 text-dark shadow-sm"
                        style="background-color: #{{ $tag->color }}">{{ $tag->name }}</a>
                @endforeach
                <a class="btn badge bg-primary p-2 text-light shadow-sm" data-toggle="modal"
                    data-target="#addTagModal">Nastavit tagy</a>
            </div>

            <div class="card p-3 mb-3 shadow rounded">
                @isset($project->description)
                    {{ $project->description }}
                @else
                    Bez popisku
                @endisset
            </div>

            <h3>Úkoly</h3>

            @livewire('project-task-manager', ['project' => $project])

            <hr>
            <h3>Poznámky</h3>


            @livewire('project-note-manager', ['project' => $project])


        </div>

        <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title" id="addTaskModalLabel">Přidat nový tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2 modal-text">Označte všechny tagy, které potřebujete:</div>
                        <form action="{{ route('tags.attachToProject', $project->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-select" name="tag_ids[]" id="" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Nastavit tagy</button>
                        </form>
                        <hr>
                        <div class="modal-text mb-2">Pokud chcete nový tag, musíte ho nejdříve vytvořit na stránce s tagy
                        </div>
                        <a href="{{ route('tags') }}" class="btn btn-dark">Stránka s tagy</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h5 class="modal-title" id="addTaskModalLabel">Odstranit projekt</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2 modal-text">Přejete si odstranit tento projekt?</div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                                Odstranit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
