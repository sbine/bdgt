@extends('guest')

@section('content')
	<div class="max-w-xl mx-auto">
        @component('components.panel')
            @include('alerts')

            <form class="form" role="form" method="POST" action="{{ route('password.email') }}">
                @csrf

                <h2 class="font-semibold text-lg text-center pb-8">{{ trans('labels.auth.reset_password') }}</h2>

                <div class="form-row {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="form-row__label">{{ trans('labels.auth.properties.email') }}</label>
                    <div class="form-row__input">
                        <input type="email" class="input-text" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-row__label"></div>
                    <div class="form-row__input">
                        <button type="submit" class="button button--primary">
                            {{ trans('labels.auth.send_password_reset_link') }}
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
    </div>
@endsection
