@if (isset($ticket))
<form action="{{ route('ticket.update', [$event->id, $ticket->id]) }}" method="POST" class="mb-8 p-6">
@method('PUT')
@else
<form action="{{ route('event', $event->id) }}" method="POST" class="mb-8 p-6">
@endif
    @csrf
    @if (isset($ticket))
    <h3 class="fs-8 mb-6">{{ __('Update ticket') }}</h3>
    @else
    <h3 class="fs-8 mb-6">{{ __('Add new ticket') }}</h3>
    @endif
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="type" class="fw-sb fs-10 mb-2">{{ __('What kind') }}? <span class="opacity-50">{{ __('Near stage, seating, standing') }}</span></label>
                <input type="text" name="type" id="type" value="{{ $ticket->type ?? old('type') }}">
                @if ($errors->has('type'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('type') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="price" class="fw-sb fs-10 mb-2">{{ __('How much') }}? <span class="opacity-50">{{ __('Price per ticket in :currency', ['currency' => env('APP_CURRENCY')]) }}</span></label>
                <input type="text" name="price" id="price" value="{{ $ticket->price ?? old('price') }}">
                @if ($errors->has('price'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('price') }}</p>
                @endif
            </div>
        </div>
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="available_amount" class="fw-sb fs-10 mb-2">{{ __('How many') }}? <span class="opacity-50">{{ __('Number of tickets of this kind') }}</span></label>
                <input type="text" name="available_amount" id="available_amount" value="{{ $ticket->available_amount ?? old('available_amount') }}">
                @if ($errors->has('available_amount'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('available_amount') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="is-flex is-justify-content-flex-end">
        @if (isset($ticket))
        <button type="submit" class="">{{ __('Update ticket') }}</button>
        @else
        <button type="submit" class="">{{ __('Add ticket') }}</button>
        @endif
    </div>
</form>