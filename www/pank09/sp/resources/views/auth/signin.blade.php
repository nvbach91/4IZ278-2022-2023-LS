@extends('layout.main')

@section('content')
<section class="container is-narrow">
    <div class="px-6 py-8">
        @include('flash-message')

        <h1 class="fs-5 mb-8">
            {{ __('Sign in to your account') }}
        </h1>
        <form action="{{ route('signin') }}" method="POST">
            @csrf
            <div class="is-flex is-flex-direction-column mb-4">
                <label for="email" class="fw-sb fs-10 mb-2">{{ __('Your email') }}</label>
                <input type="email" name="email" id="email" placeholder="pank09@vse.cz">
                @if ($errors->has('email'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="is-flex is-flex-direction-column mb-4">
                <label for="password" class="fw-sb fs-10 mb-2">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" placeholder="••••••••">
                @if ($errors->has('password'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="columns is-mobile is-align-items-center">
                <div class="column is-narrow">
                    <button type="submit">{{ __('Sign in') }}</button>
                </div>
                <div class="column is-narrow">
                    or login using <a href="{{ route('signin.facebook') }}">Facebook</a>
                </div>
            </div>
            <p class="fs-9 is-text-center mt-8">
                {{ __('Don\'t have an account') }}? <a href="{{ route('signup') }}">{{ __('Sign up') }}</a>
            </p>
        </form>
    </div>
</section>
@endsection