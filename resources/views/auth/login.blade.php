@extends('guest')

@section('breadcrumbs.items')
	<li class="active">{{ trans('labels.auth.login') }}</li>
@endsection

@section('alerts')
@overwrite

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('labels.auth.login') }} <a class="pull-right" href="{{ route('register') }}">{{ trans('labels.auth.register_button') }}</a></div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">{{ trans('labels.auth.properties.email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">{{ trans('labels.auth.properties.password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('labels.auth.properties.remember') }}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									{{ trans('labels.auth.login') }}
								</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ trans('labels.auth.forgot_password') }}
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
