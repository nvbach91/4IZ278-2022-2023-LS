<div class="list mt-10">
    @if ($event->tickets->isEmpty())
    <p class="fw-m fs-8">{{ __('No tickets available') }}</p>
    @endif
    @foreach ($event->tickets as $ticket)
    <div class="ticket columns is-align-items-flex-end is-justify-content-space-between">
        <div class="column">
            <div class="columns is-align-items-center">
                <div class="column">
                    <h4 class="fs-8 fw-sb mb-2">{{ $ticket->type }}</h4>
                    <div class="fs-11 opacity-50">{{ $ticket->remaining_amount }} available</div>
                </div>
            </div>
        </div>
        <div class="column is-narrow">
            <div class="is-flex is-align-items-center">
                <form method="POST" action="{{ route('ticket.book', [$event->id, $ticket->id]) }}">
                    @csrf
                    <div class="is-flex is-align-items-center">
                        <span class="fs-10 fw-sb">{{ $ticket->formatted_price }}</span>
                        <span class="fs-10 fw-sb mx-2">x</span>
                        <input type="number" value="1" min="1" name="amount" class="quantity" style="width: 80px;">
                        <span class="fs-11 fw-sb opacity-50 ml-1">{{ __('tickets') }}</span>
                        <button class="ml-2">{{ __('Book now') }}</button>
                    </div>
                </form>
                @if (auth()->check() && auth()->user()->is_admin)
                <button class="is-position-relative ml-2" type="button">
                    Edit
                    <a href="{{ route('ticket.edit', [$event->id, $ticket->id]) }}" class="is-position-absolute" style="top:0;left:0;right:0;bottom:0;"></a>
                </button>
                <form action="{{ route('ticket.delete', [$event->id, $ticket->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="ml-2">
                        Delete
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>