@extends('layout.main')

@section('content')
<section class="container is-narrow">
    <div class="px-6 py-8">
        @include('flash-message')

        <h1 class="fs-5 mb-8">
            {{ __('Create new account') }}
        </h1>
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <div class="is-flex is-flex-direction-column mb-4">
                <label for="name" class="fw-sb fs-10 mb-2">{{ __('Full name') }}</label>
                <input type="text" name="name" id="name" placeholder="Konstantin Pankratov" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="text-error fs-10 p-2">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="is-flex is-flex-direction-column mb-4">
                <label for="email" class="fw-sb fs-10 mb-2">{{ __('Your email') }}</label>
                <input type="email" name="email" id="email" placeholder="pank09@vse.cz" value="{{ old('email') }}">
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
            <button type="submit" class="">{{ __('Sign up') }}</button>

            <p class="fs-9 is-text-center mt-8">
                {{ __('Already have an account?') }} <a href="{{ route('signin') }}">{{ __('Sign in') }}</a>
            </p>
        </form>
    </div>
</section>
@endsection