<div>
    <div class="p-2 shadow-sm rounded bg-dark my-3">
        <a href="{{ route('projects.create') }}" class="btn btn-light">Nový projekt</a>
        <form class="float-right">
            <input type="text" id="searchInput" class="form-control" wire:model="searchTerm" placeholder="Vyhledat...">
        </form>
    </div>
    <div class="row">
        @foreach ($projects as $project)
            @component('components.project-card', ['project' => $project])
            @endcomponent
        @endforeach
    </div>
</div>
