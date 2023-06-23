<div>
    <div class="p-2 shadow-sm rounded bg-dark mb-3">
        <a href="{{ route('notes.create') }}" class="btn btn-light">Nová poznámka</a>
        <div class="float-right">
            <form action="/search-projects" method="get">
                <input type="text" id="searchInput" class="form-control" wire:model="searchTerm" placeholder="Vyhledat...">
            </form>       
        </div>
    </div>
    <div class="row">
        @foreach ($notes as $note)
        @component('components.note-card', ['note' => $note])
        @endcomponent
    @endforeach
    </div>
</div>

