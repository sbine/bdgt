@extends('guest')

@section('content')
	<div class="bg-white shadow">
		<div class="bg-blue-700 rounded-t px-4 py-1"></div>

		<form class="w-3/4 mx-auto px-4 py-10" role="form" method="POST" action="{{ route('password.request') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <h2 class="font-semibold text-lg text-center pb-6">{{ trans('labels.auth.reset_password') }}</h2>

            <div class="flex items-center {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="w-2/3 text-right pr-6">{{ trans('labels.auth.properties.email') }}</label>
                <div class="flex flex-col w-2/3">
                    <input type="email" class="input-text" name="email" value="{{ old('email', $email) }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="input-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex items-center {{ $errors->has('password') ? 'has-error' : '' }}">
                <label class="w-2/3 text-right pr-6">{{ trans('labels.auth.properties.password') }}</label>
                <div class="flex flex-col w-2/3">
                    <input type="password" class="input-text" name="password" required>

                    @if ($errors->has('password'))
                        <span class="input-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex items-center {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                <label class="w-2/3 text-right pr-6">{{ trans('labels.auth.properties.password_confirmation') }}</label>
                <div class="flex flex-col w-2/3">
                    <input type="password" class="input-text" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="input-error">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

			<div class="flex flex-col items-end mt-8">
				<div class="w-2/3">
					<button type="submit" class="button">
                        {{ trans('labels.auth.reset_password') }}
					</button>
				</div>
			</div>
        </form>
    </div>
@endsection
