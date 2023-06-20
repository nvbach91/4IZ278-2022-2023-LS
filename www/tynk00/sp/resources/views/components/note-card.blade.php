<div class="col-lg-2 col-md-6 col-sm-12">
    <a class="text-decoration-none custom-link" href="{{ route('notes.edit', $note->id) }}">
        <div class="card note rounded shadow mb-5 mx-auto"
            style="background-color: #{{ $note->color }}">
            <div class="card-body p-3">
                <h5 class="card-title">{{ $note->title }}</h5>
                <p class="card-body p-0">
                    {{ Illuminate\Support\Str::limit($note->body, 118, '...') }}
                </p>
            </div>
            <div class="card-footer">
                {{ Illuminate\Support\Str::limit($note->lastUpdate(), 10, '...') }} |
                @if($note->project != null)
                {{ $note->project->name }}
                @else
                Bez projektu
                @endif
            </div>

        </div>
    </a>

</div>