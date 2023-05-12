@if (isset($event))
<form action="{{ route('event.update', $event->id) }}" method="POST" class="mb-8 p-6">
@method('PUT')
@else
<form action="{{ route('event.store') }}" method="POST" class="mb-8 p-6">
@endif

    @csrf
    @if (isset($event))
    <h3 class="fs-8 mb-6">{{ __('Update event') }}</h3>
    @else
    <h3 class="fs-8 mb-6">{{ __('Add new event') }}</h3>
    @endif
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="title" class="fw-sb fs-10 mb-2">{{ __('Who') }}? <span class="opacity-50">{{ __('Artist name') }}</span></label>
                <input type="text" name="title" id="title" value="{{ $event->title ?? old('title') }}">
                @if ($errors->has('title'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('title') }}</p>
                @endif
            </div>
        </div>
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="datetime" class="fw-sb fs-10 mb-2">{{ __('When') }}? <span class="opacity-50">{{ __('Date and time') }}</span></label>
                <input type="datetime-local" name="datetime" id="datetime" value="{{ $event->datetime ?? old('datetime') }}">
                @if ($errors->has('datetime'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('datetime') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="image" class="fw-sb fs-10 mb-2">{{ __('Cover') }}? <span class="opacity-50">{{ __('Image URL') }}</span></label>
                <input type="text" name="image" id="image" value="{{ $event->image ?? old('image') }}">
                @if ($errors->has('image'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('image') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="place" class="fw-sb fs-10 mb-2">{{ __('Where') }}? <span class="opacity-50">{{ __('Place') }}</span></label>
                <input type="text" name="place" id="place" value="{{ $event->place ?? old('place') }}">
                @if ($errors->has('place'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('place') }}</p>
                @endif
            </div>
        </div>
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="city" class="fw-sb fs-10 mb-2"><span class="opacity-50">{{ __('City') }}</span></label>
                <input type="text" name="city" id="city" value="{{ $event->city ?? old('city') }}">
                @if ($errors->has('city'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('city') }}</p>
                @endif
            </div>
        </div>
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="country" class="fw-sb fs-10 mb-2"><span class="opacity-50">{{ __('Country') }}</span></label>
                <input type="text" name="country" id="country" value="{{ $event->country ?? old('country') }}">
                @if ($errors->has('country'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('country') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="is-flex is-flex-direction-column">
                <label for="description" class="fw-sb fs-10 mb-2">{{ __('What') }}? <span class="opacity-50">{{ __('Description') }}</span></label>
                <textarea name="description" id="description" cols="30" rows="5">{{ $event->description ?? old('description') }}</textarea>
                @if ($errors->has('description'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('description') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="is-flex is-justify-content-flex-end">
        @if (isset($event))
        <button type="submit" class="">{{ __('Update event') }}</button>
        @else
        <button type="submit" class="">{{ __('Add event') }}</button>
        @endif
    </div>
</form>