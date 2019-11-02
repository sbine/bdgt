@extends('guest')

@section('content')
	<div class="max-w-xl mx-auto">
		@component('components.panel')
			<form class="form" role="form" method="POST" action="{{ route('login') }}">
				@csrf

				<h2 class="font-semibold text-lg text-center pb-8">{{ trans('labels.auth.login') }}</h2>

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

				<div class="form-row items-baseline {{ $errors->has('password') ? 'has-error' : '' }}">
					<label class="form-row__label">{{ trans('labels.auth.properties.password') }}</label>
					<div class="form-row__input">
						<input type="password" class="input-text" name="password" required>

						@if ($errors->has('password'))
							<span class="input-error">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif

						<a class="link text-xs" href="{{ route('password.request') }}">
							{{ trans('labels.auth.forgot_password') }}
						</a>
					</div>
				</div>

				<div class="form-row">
					<div class="form-row__label"></div>
					<div class="form-row__input">
						<label class="flex items-center">
							<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="mr-3"> {{ trans('labels.auth.properties.remember') }}
						</label>

						<div class="flex items-center mt-8">
							<button type="submit" class="button button--primary">
								{{ trans('labels.auth.login') }}
							</button>
						</div>
					</div>
				</div>
			</form>

			@slot('footer')
				Don't have an account yet?
				<a class="link" href="{{ route('register') }}">{{ trans('labels.auth.register_button') }}</a>
			@endslot
		@endcomponent
	</div>
@endsection
