@extends('guest')

@section('content')
	<div class="bg-white shadow">
		<div class="bg-blue-700 rounded-t px-4 py-1"></div>

		<form class="w-3/4 mx-auto px-4 py-10" role="form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <h2 class="font-semibold text-lg text-center pb-6">{{ trans('labels.auth.reset_password') }}</h2>

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

			<div class="flex flex-col items-end mt-6">
				<div class="w-2/3">
                    <button type="submit" class="button">
                        {{ trans('labels.auth.send_password_reset_link') }}
                    </button>
				</div>
			</div>
        </form>
    </div>
</div>
@endsection
