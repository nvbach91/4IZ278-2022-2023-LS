<div class="col-md-3 mb-3">
    <div class="card shadow" style="background-color: #{{ $project->color }}">
        <div class="card-header">
            <h5 class="card-title m-0">{{ $project->name }}</h5>
        </div>
        <div class="card-body">
            @isset($project->description)
                <p class="card-text">{{ $project->description }}</p>
            @else
                <p class="card-text">Bez popisku</p>
            @endisset
    
            @if ($project->tasks->count() > 0)
                <p class="card-text">Úkoly:
                    {{ $project->tasks->where('completed', 1)->count() }}/{{ $project->tasks->count() }}
                    ({{ ($project->tasks->where('completed', 1)->count() / $project->tasks->count()) * 100 }}%)
                </p>
            @else
                <p class="card-text">Žádné úkoly</p>
            @endif
            @if ($project->notes->count() > 0)
                <p class="card-text">Poznámky: {{ $project->notes->count() }}</p>
            @else
                <p class="card-text">Bez poznámek</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Zobrazit</a>
        </div>
    
    
    </div>          
</div>