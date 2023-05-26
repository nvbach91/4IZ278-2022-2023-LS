<form action="{{ route('home') }}" method="GET" class="mb-8">
    <div class="is-flex is-flex-direction-column">
        <label for="search_query" class="fw-sb fs-10 mb-2">{{ __('Search for event') }}</label>
        <input type="text" name="search_query" id="search_query" value="{{ $search_query ?? old('search_query') }}" placeholder="{{ __('Enter artist name') }}">
        @if ($errors->has('search_query'))
            <p class="text-error fs-10 p-2">{{ $errors->first('search_query') }}</p>
        @endif
    </div>

    @if (isset($search_query))
        <h3 class="fs-8 mt-6"><span class="opacity-50">Results for</span> {{ $search_query }}</h3>
    @endif
</form>