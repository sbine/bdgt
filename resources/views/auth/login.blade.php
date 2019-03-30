@extends('guest')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.auth.login') }}</div>
@endsection

@section('alerts')
@overwrite

@section('content')
	<div class="shadow">
		<div class="flex justify-between bg-gray-200 border-blue-700 border-t-4 rounded-t px-4 py-2">
			<h2>{{ trans('labels.auth.login') }}</h2>
			<a class="link" href="{{ route('register') }}">{{ trans('labels.auth.register_button') }}</a>
		</div>
		<div class="px-4 py-2 rounded-b">
			<form class="w-3/4 mx-auto" role="form" method="POST" action="{{ route('login') }}">
				@csrf

				<div class="flex items-center justify-between my-4 {{ $errors->has('email') ? 'has-error' : '' }}">
					<label class="mr-4">{{ trans('labels.auth.properties.email') }}</label>
					<div class="flex flex-col w-2/3">
						<input type="email" class="input-text" name="email" value="{{ old('email') }}" required autofocus>

						@if ($errors->has('email'))
							<span class="input-error">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="flex items-center justify-between mb-6 {{ $errors->has('password') ? 'has-error' : '' }}">
					<label class="mr-4">{{ trans('labels.auth.properties.password') }}</label>
					<div class="flex flex-col w-2/3">
						<input type="password" class="input-text" name="password" required>

						@if ($errors->has('password'))
							<span class="input-error">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="flex flex-col items-end mb-4">
					<div class="w-2/3">
						<label class="flex items-center mb-8">
							<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="mr-3"> {{ trans('labels.auth.properties.remember') }}
						</label>

						<div class="flex items-center">
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
		</div>
	</div>
@endsection
