@extends('guest')

@section('content')
    <div class="max-w-xl mx-auto">
        @component('components.panel')
            @include('alerts')

            <form class="form" role="form" method="POST" action="{{ route('register') }}">
                @csrf

                <h2 class="font-semibold text-lg text-center pb-8">{{ trans('labels.auth.register') }}</h2>

                @honeypot

                <div class="form-row {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.email') }}</label>
                    <div class="form-row__input">
                        <input type="email" class="input-text" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-row {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.password') }}</label>
                    <div class="form-row__input">
                        <input type="password" class="input-text" name="password" required>
                    </div>
                </div>

                <div class="form-row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.password_confirmation') }}</label>
                    <div class="form-row__input">
                        <input type="password" class="input-text" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__label"></div>
                    <div class="form-row__input">
                        <button type="submit" class="button button--primary mt-6">
                            {{ trans('labels.auth.register') }}
                        </button>
                    </div>
                </div>
            </form>

            @slot('footer')
                Already have an account?
                <a class="link" href="{{ route('login') }}">{{ trans('labels.auth.login') }}</a>
            @endslot
        @endcomponent
    </div>
@endsection
