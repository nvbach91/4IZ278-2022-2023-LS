@extends('layout.main')

@section('content')
<section class="container is-narrow">
    <div class="event is-single mb-15">
        @include('flash-message')

        <figure class="event__image" style="background-image: url({{ $event->image }});">
            <h2>{{ $event->title }}</h2>
        </figure>
        <div class="columns is-align-items-center is-justify-content-space-between is-mobile p-4 mt-2">
            <div class="column">
                <h4 class="fs-8 fw-bo">{{ $event->date }}</h4>
                <h5 class="fs-9 fw-sb opacity-50">{{ $event->time }}</h5>
            </div>
            <div class="column">
                <h4 class="fs-8 fw-bo">{{ $event->place }}</h4>
                <h5 class="fs-9 fw-sb opacity-50">{{ sprintf("%s, %s", ucfirst($event->city), ucfirst($event->country)) }}</h5>
            </div>
        </div>
        
        <p class="fs-8 lh-lg" style="white-space:break-spaces;">{{ $event->description }}</p>


        <h2 class="my-8">{{ __('Tickets') }}</h2>

        @if (auth()->check() && auth()->user()->is_admin)
        @include('ticket.form')
        @endif
        @include('ticket.show')
    </div>
</section>
@endsection