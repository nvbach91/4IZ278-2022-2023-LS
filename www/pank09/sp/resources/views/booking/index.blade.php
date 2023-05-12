@extends('layout.main')

@section('content')
<section class="container is-narrow">
    @include('flash-message')

    @if (auth()->check() && auth()->user()->is_admin)
    <h2 class="mb-8">{{ __('All bookings') }}</h2>
    @else
    <h2 class="mb-8">{{ __('Your bookings') }}</h2>
    @endif

    <div class="list">
        @if ($bookings->isEmpty())
            <p class="fw-m fs-8">{{ __('No bookings yet.') }}</p>
        @endif
        @foreach($bookings as $booking)
            <article class="columns is-align-items-flex-end mb-10">
                <div class="column">
                    <h3 class="fs-8 fw-sb mb-3">{{ $booking->ticket->event->title }}</h3>
                    <div class="columns">
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ $booking->ticket->event->date }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">{{ $booking->ticket->event->time }}</h5>
                        </div>
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ $booking->ticket->event->place }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">{{ sprintf("%s, %s", ucfirst($booking->ticket->event->city), ucfirst($booking->ticket->event->country)) }}</h5>
                        </div>
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ __('Ticket type') }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">{{ $booking->ticket->type }}</h5>
                        </div>
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ __('Quantity') }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">{{ $booking->amount }}</h5>
                        </div>
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ __('Booked at') }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">{{ $booking->created_at }}</h5>
                        </div>
                        @if (auth()->check() && auth()->user()->is_admin)
                        <div class="column is-narrow">
                            <h4 class="fs-10 fw-bo">{{ __('Owner') }}</h4>
                            <h5 class="fs-11 fw-sb opacity-50">
                                {{ $booking->owner->name }}<br>
                                {{ $booking->owner->email }}<br>
                            </h5>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="column is-narrow">
                    <form action="{{ route('booking.unbook', $booking->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="is-position-relative">
                            Unbook
                        </button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    {{ $bookings->links('components.pagination') }}
</section>
@endsection