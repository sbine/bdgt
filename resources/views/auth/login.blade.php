@extends('guest')

@section('content')
	<div class="bg-white shadow">
		<div class="bg-blue-700 rounded-t px-4 py-1"></div>

		<form class="w-3/4 mx-auto px-4 py-10" role="form" method="POST" action="{{ route('login') }}">
			@csrf

            <h2 class="font-semibold text-lg text-center pb-6">{{ trans('labels.auth.login') }}</h2>

			<div class="flex items-center {{ $errors->has('email') ? 'has-error' : '' }}">
				<label class="w-1/3 text-right pr-6">{{ trans('labels.auth.properties.email') }}</label>
				<div class="flex flex-col w-2/3">
					<input type="email" class="input-text" name="email" value="{{ old('email') }}" required autofocus>

					@if ($errors->has('email'))
						<span class="input-error">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="flex items-center mt-4 {{ $errors->has('password') ? 'has-error' : '' }}">
				<label class="w-1/3 text-right pr-6">{{ trans('labels.auth.properties.password') }}</label>
				<div class="flex flex-col w-2/3">
					<input type="password" class="input-text" name="password" required>

					@if ($errors->has('password'))
						<span class="input-error">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="flex flex-col items-end mt-6">
				<div class="w-2/3">
					<label class="flex items-center">
						<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="mr-3"> {{ trans('labels.auth.properties.remember') }}
					</label>

					<div class="flex items-center mt-8">
						<button type="submit" class="button mr-8">
							{{ trans('labels.auth.login') }}
						</button>

						<a class="link text-sm" href="{{ route('password.request') }}">
							{{ trans('labels.auth.forgot_password') }}
						</a>
					</div>
				</div>
			</div>
		</form>

		<div class="bg-gray-100 border-t text-center text-gray-600 text-sm rounded-b p-4">
			Don't have an account yet?
			<a class="link" href="{{ route('register') }}">{{ trans('labels.auth.register_button') }}</a>
		</div>
	</div>
@endsection
