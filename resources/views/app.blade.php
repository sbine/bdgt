<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
</head>
<body class="leading-normal">
	<div class="flex flex-col min-h-screen">
		<div id="app" class="flex-grow bg-gray-100">
			@include('partials.nav')

			<div class="w-11/12 xl:w-3/4 mx-auto" v-cloak>
				<main class="min-h-full my-6">

					@include('alerts')

					<div class="flex justify-between mb-8">
						@section('breadcrumbs')
							<div class="flex">
								<a class="link block text-sm py-2" href="{{ route('dashboard') }}">{{ trans('labels.main.home') }}</a>
								@yield('breadcrumbs.items')
							</div>
							<div class="flex self-end">
								@yield('breadcrumbs.actions')
							</div>
						@show
					</div>

					@yield('top-content')

					<div class="mt-8">
						@yield('content')
					</div>
				</main>
			</div>
		</div>

		@include('partials.footer')
	</div>

	@include('partials.scripts')
</body>
</html>
