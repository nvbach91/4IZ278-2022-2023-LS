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
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-light me-2"><i
                        class="fa fa-pencil-square-o" aria-hidden="true"></i> Upravit</a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                        Odstranit</button>
                </form>
            </div>
        </div>
        <div class="card-body">

            <div class="pb-3">
                @foreach($project->tags as $tag)
                    <a class="btn badge p-2 text-dark shadow-sm" style="background-color: #{{ $tag->color }}">{{ $tag->name }}</a>
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

            <div class="row">
                <div class="col">
                    <h3>Úkoly</h3>
                </div>

            </div>
            
            @livewire('project-task-manager', ['project' => $project])




        <div class="card bg-note-selection rounded mt-3">
            <div class="card-header">
                <h3>{{ __('Poznámky') }} ({{ $project->notes->count() }})</h3>
            </div>

            <div class="card-body">
                <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Nová poznámka</a>
                <div class="row">
                    @foreach ($project->notes as $note)
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <a class="text-decoration-none custom-link" href="{{ route('notes.edit', $note->id) }}">
                                <div class="card note rounded shadow-lg mb-3 mx-auto"
                                    style="height: 250px; width: 250px; background-color: #{{ $note->color }}">
                                    <div class="card-body p-3">
                                        <h5 class="card-title">{{ $note->title }}</h5>
                                        <p class="card-body p-0">
                                            {{ Illuminate\Support\Str::limit($note->body, 118, '...') }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        {{ $note->lastUpdate() }} | {{ $note->project->name }}

                                    </div>

                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>



        </div>



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
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Nastavit tagy</button>
                    </form>
                    <hr>
                    <div class="modal-text mb-2">Pokud chcete nový tag, musíte ho nejdříve vytvořit na stránce s tagy</div>
                    <a href="{{ route('tags') }}" class="btn btn-dark">Stránka s tagy</a>
                </div>
            </div>
        </div>
    </div>
@endsection
