@extends('layout.main')

@section('content')
<section class="container">
    <div class="events">
        @include('flash-message')

        <h2 class="mb-8">{{ __('Concerts') }}</h2>

        @if (auth()->check() && auth()->user()->is_admin)
        @include('event.form')
        @endif

        <div class="list">
            @if ($events->isEmpty())
                <p class="fw-m fs-8">{{ __('No concerts available') }}</p>
            @endif
            @foreach($events as $event)
                <article class="event columns is-align-items-center">
                    <div class="column">
                        <div class="columns is-align-items-center is-mobile">
                            <div class="column is-narrow">
                                <figure class="event__image" style="background-image: url({{ $event->image }});"></figure>
                            </div>
                            <div class="column">
                                <h3 class="fs-8 fw-sb">{{ $event->title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="column is-narrow">
                        <div class="columns is-align-items-center is-justify-content-space-between is-mobile">
                            <div class="column event__details-column">
                                <h4 class="fs-9 fw-bo">{{ $event->date }}</h4>
                                <h5 class="fs-10 fw-sb opacity-50">{{ $event->time }}</h5>
                            </div>
                            <div class="column event__details-column">
                                <h4 class="fs-9 fw-bo">{{ $event->place }}</h4>
                                <h5 class="fs-10 fw-sb opacity-50">{{ sprintf("%s, %s", ucfirst($event->city), ucfirst($event->country)) }}</h5>
                            </div>
                        </div>
                    </div>
                    @if (auth()->check() && auth()->user()->is_admin)
                    <div class="column is-narrow">
                        <div class="is-flex">
                            <button class="is-position-relative" style="z-index: 20;">
                                Edit
                                <a href="{{ route('event.edit', $event->id) }}" class="is-position-absolute" style="top:0;left:0;right:0;bottom:0;"></a>
                            </button>
                            <form action="{{ route('event.delete', $event->id) }}" method="POST" class="is-position-relative ml-2" style="z-index: 20;">
                                @method('DELETE')
                                @csrf
                                <button class="is-position-relative">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('event', $event->id) }}"></a>
                </article>
            @endforeach
        </div>
        {{ $events->links('components.pagination') }}
    </div>
</section>
@endsection