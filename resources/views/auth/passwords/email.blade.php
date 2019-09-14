@extends('guest')

@section('content')
	<div class="bg-white rounded-sm shadow">
		<div class="bg-blue-700 rounded-t px-4 py-1"></div>

		<form class="form py-8" role="form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <h2 class="font-semibold text-lg text-center pb-8">{{ trans('labels.auth.reset_password') }}</h2>

            <div class="form-row {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="form-row__label">{{ trans('labels.auth.properties.email') }}</label>
                <div class="form-row__input">
                    <input type="email" class="input-text" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="input-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
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
    </div>
</div>
@endsection
