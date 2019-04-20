<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
</head>
<body>
	<div class="flex flex-col min-h-screen">
		<div id="app" class="flex-grow bg-gray-100">
			@include('partials.nav')

			<div class="w-5/6 xl:w-2/3 mx-auto" v-cloak>
				<main class="min-h-full my-6">

					@section('alerts')
						@include('alerts')
					@show

					<div class="flex justify-between mb-10">
						@section('breadcrumbs')
							<div class="flex">
								<a class="link block text-sm py-2" href="{{ route('index') }}">Home</a>
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

					@auth
						@include('transaction.modals.create')
					@endauth
				</main>
			</div>
		</div>

		@include('partials.footer')
	</div>

	@include('partials.scripts')
</body>
</html>
