@extends('guest')

@section('content')
	<div class="max-w-xl mx-auto">
        @component('components.panel')
            <form class="form" role="form" method="POST" action="{{ route('password.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <h2 class="font-semibold text-lg text-center pb-8">{{ trans('labels.auth.reset_password') }}</h2>

                <div class="form-row {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.email') }}</label>
                    <div class="form-row__input">
                        <input type="email" class="input-text" name="email" value="{{ old('email', $email) }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="input-error">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.password') }}</label>
                    <div class="form-row__input">
                        <input type="password" class="input-text" name="password" required>

                        @if ($errors->has('password'))
                            <span class="input-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.password_confirmation') }}</label>
                    <div class="form-row__input">
                        <input type="password" class="input-text" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="input-error">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col items-end mt-8">
                    <div class="form-row__label"></div>
                    <div class="form-row__input">
                        <button type="submit" class="button button--primary mt-8">
                            {{ trans('labels.auth.reset_password') }}
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
    </div>
@endsection
