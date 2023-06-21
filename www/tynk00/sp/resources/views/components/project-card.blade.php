<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
    <div class="card shadow" style="background-color: #{{ $project->color }}">
        <div class="card-header bg-dark text-light">
            <h4 class="card-title m-0">{{ Illuminate\Support\Str::limit($project->name, 26, '...') }}</h4>
        </div>
        <div class="card-body fw-medium">
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
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        </div>
    
    
    </div>          
</div>