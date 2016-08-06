<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
</head>
<body>
	@include('partials.nav')

	<div id="wrapper">
		@section('alerts')
			@include('alerts')
		@show

		<br><br><!-- No one saw that -->

		@yield('top-content')

		<div class="container-fluid">
			<div class="row">
				<div class="{{ config('layout.grid_class') }}">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	@include('partials.footer')

	@include('partials.scripts')
</body>
</html>
