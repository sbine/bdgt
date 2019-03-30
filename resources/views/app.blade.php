<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
</head>
<body>
	<div class="flex flex-col min-h-screen">
		<div id="app" class="flex-grow">
			@include('partials.nav')

			<div class="w-5/6 lg:w-2/3 mx-auto">
				<main class="min-h-full py-6">

					@section('alerts')
						@include('alerts')
					@show

					<div class="flex justify-between mb-10">
						@section('breadcrumbs')
							<div class="flex justify-between">
								<div class="flex">
									<a class="link block text-sm py-2" href="{{ route('index') }}">Home</a>
									@yield('breadcrumbs.items')
								</div>
								<div class="flex self-end">
									@yield('breadcrumbs.actions')
								</div>
							</div>
						@show

						<a class="button block sm:inline-block" href="#addTransactionModal" data-toggle="modal">
							<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> Add Transaction
						</a>
					</div>

					@yield('top-content')

					<div class="p-4">
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
